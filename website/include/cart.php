<?php
require_once("ourdb.php");

class Cart
{

   static public $ACTION_URL = "/cart/action.php";
   static public $CONFIRM_URL = "/cart/confirm.php";
   static public $REVIEW_URL = "/cart/review.php";
   static public $ADD_COUPON_URL = "/cart/add_coupon.php";

   function add_coupon($cartid, $couponcode)
   {
      $query = sprintf("SELECT * from `coupons` where code = '%s' LIMIT 1;", mysql_real_escape_string($couponcode));
      if (!$res = mysql_query($query))
      {
	 return False;
      }
      if (!$arr = mysql_fetch_assoc($res))
      {
	 return False;
      }
      $couponid = $arr['id'];
      $query = sprintf("INSERT into `cart_coupons` (`cart_id`, `coupon_id`) VALUES ('%d', '%d');",
                        mysql_real_escape_string($cartid),
                        mysql_real_escape_string($couponid));
      return mysql_query($query);
   }

   function get_cart($userid)
   {
      $query = sprintf("SELECT * from cart where user_id = '%d' limit 1;",
		       mysql_real_escape_string($userid));
      $res = mysql_query($query);
      if ($res)
      {
	 return mysql_fetch_assoc($res);
      }
      else
      {
	 return False;
      }      
   }

   function create_cart($userid)
   {
      $query = sprintf("INSERT into `cart` (`id`, `user_id`, `created_on`) VALUES (NULL, '%d', NOW());",
		       mysql_real_escape_string($userid));
      if (mysql_query($query))
      {
	 return mysql_insert_id();
      }
      else
      {
	 return False;
      }      
   }

   function add_to_cart($cartid, $picid)
   {
      $query = sprintf("INSERT into `cart_items` (`id`, `cart_id`, `picture_id`) VALUES (NULL, '%d', '%d');",
		       mysql_real_escape_string($cartid),
		       mysql_real_escape_string($picid));
      if (mysql_query($query))
      {
	 return mysql_insert_id();
      }
      else
      {
	 return False;
      }      
   }


   function delete_from_cart($cartid, $picid)
   {
      $query = sprintf("DELETE from `cart_items` where cart_id = '%d' and picture_id = '%d' limit 1;",
		       mysql_real_escape_string($cartid),
		       mysql_real_escape_string($picid));
      if (mysql_query($query))
      {
	 return True;
      }
      else
      {
	 return False;
      }      
   }

   function cart_items($cartid)
   {
      $query = sprintf("SELECT * from cart_items, pictures where cart_items.cart_id = '%d' and cart_items.picture_id = pictures.id;",
		       mysql_real_escape_string($cartid));
      $res = mysql_query($query);
      if ($res)
      {
	 while ($row = mysql_fetch_assoc($res))
	 {
	    $to_ret[] = $row;
	 }
	 return $to_ret;
      }
      else
      {
	 return False;
      }      
   }

   function cart_coupons($cartid)
   {
      $query = sprintf("SELECT coupons.code, coupons.discount from cart_coupons, coupons where cart_coupons.cart_id = '%d' and cart_coupons.coupon_id = coupons.id;",
		       mysql_real_escape_string($cartid));
      $res = mysql_query($query);
      if ($res)
      {
	 while ($row = mysql_fetch_assoc($res))
	 {
	    $to_ret[] = $row;
	 }
	 return $to_ret;
      }
      else
      {
	 return False;
      }      
   }

   function cart_total($cartid)
   {
      $coupons = Cart::cart_coupons($cartid);
      $query = sprintf("SELECT SUM(pictures.price) from cart_items, pictures where cart_items.cart_id = '%d' and cart_items.picture_id = pictures.id;",
		       mysql_real_escape_string($cartid));
      $res = mysql_query($query);
      if ($res)
      {
	 $row = mysql_fetch_row($res);
	 $sum = $row[0];	 
	 if ($coupons)
	 {
	    foreach ($coupons as $coupon)
	    {
	       $sum *= $coupon['discount'] / 100.0;
	    }
	 }
	 return $sum;
      }
      else
      {
	 return False;
      }      		       
   }

   function purchase($cart)
   {
      mysql_query("BEGIN;");
      $items = Cart::cart_items($cart['id']);
      $coupons = Cart::cart_coupons($cartid);
      $sum = 0;
      foreach ($items as $item)
      {
	 $sum += $item['price'];
	 $query = sprintf("INSERT into `own` (`id`, `user_id`, `picture_id`) VALUES (NULL, '%d', '%d');",
			  mysql_real_escape_string($cart['user_id']),
			  mysql_real_escape_string($item['picture_id']));	 
	 if (!mysql_query($query))
	 {
	    mysql_query("ROLLBACK;");
	    return False;
	 }
	 $query = sprintf("UPDATE `users` set tradebux = tradebux + %d where id = '%d' limit 1;",
			  mysql_real_escape_string($item['price']),
			  mysql_real_escape_string($item['user_id']));
	 if (!mysql_query($query))
	 {
	    mysql_query("ROLLBACK;");
	    return False;
	 }
      }
      if ($coupons)
      {
	 foreach ($coupons as $coupon)
	 {
	    $sum *= $coupon['discount'] / 100.0;
	 }
      }
      
      $query = sprintf("UPDATE `users` set tradebux = tradebux - %d where id = '%d' limit 1;",
		       mysql_real_escape_string($sum),
		       mysql_real_escape_string($cart['user_id']));
      if (!mysql_query($query))
      {
	 mysql_query("ROLLBACK;");
	 return False;
      }
      
      if (!Cart::delete_cart($cart['id'], True))
      {
	 mysql_query("ROLLBACK;");
	 return False;
      }
      
      mysql_query("COMMIT;");
      return True;
   }

   function delete_cart($cartid, $in_transaction)
   {
      if (!$in_transaction)
      {
	 mysql_query("BEGIN;");
      }
      $query = sprintf("DELETE from cart_items where cart_items.cart_id = '%d'",
		       mysql_real_escape_string($cartid));
      if (!mysql_query($query))
      {
	 if (!$in_transaction)
	 {
	    mysql_query("ROLLBACK;");
	 }
	 return False;
      }
      $query = sprintf("DELETE from cart where id = '%d' limit 1;",
		       mysql_real_escape_string($cartid));
      if (!mysql_query($query))
      {
	 if (!$in_transaction)
	 {
	    mysql_query("ROLLBACK;");
	 }
	 return False;
      }
      
      if (!$in_transaction)
      {
	 mysql_query("COMMIT;");
      }
      return True;
   }
}
?>