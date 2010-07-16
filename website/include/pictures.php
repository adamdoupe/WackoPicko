<?php

require_once("ourdb.php");

class Pictures
{

   static public $VIEW_PIC_URL = "/pictures/view.php";
   static public $CONFLICT_URL = "/pictures/conflict.php";
   static public $HIGH_QUALITY_URL = "/pictures/highquality.php";
   static public $RECENT_URL = "/pictures/recent.php";
   function get_all_pictures_by_user($userid)
   {
      $query = sprintf("SELECT *, UNIX_TIMESTAMP(created_on) as created_on_unix from pictures where user_id = '%d'",
		       mysql_real_escape_string($userid));
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
   function get_some_pictures_by_user($userid, $not_this, $limit)
   {
      $query = sprintf("SELECT pictures.filename, pictures.id, pictures.user_id, users.login from pictures, users where pictures.id != '%d' and pictures.user_id = '%d' and pictures.user_id = users.id order by RAND() limit %d;",
		       mysql_real_escape_string($not_this),
		       mysql_real_escape_string($userid),
		       mysql_real_escape_string($limit));
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

   function get_some_pictures_by_tag($tag, $not_this, $limit)
   {
      $query = sprintf("SELECT pictures.filename, pictures.id, pictures.user_id, users.login from pictures, users where pictures.id != '%d' and pictures.tag like '%s' and pictures.user_id = users.id order by RAND() limit %d;",
		       mysql_real_escape_string($not_this),
		       mysql_real_escape_string($tag),
		       mysql_real_escape_string($limit));
      $res = mysql_query($query) or die(mysql_error());
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

   function get_all_pictures_by_tag($tag)
   {
      $query = sprintf("SELECT *, UNIX_TIMESTAMP(created_on) as created_on_unix from pictures where tag like '%s'",
		       mysql_real_escape_string($tag));
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

   function get_recent_pictures($limit = 10)
   {
      $query = sprintf("SELECT * from `pictures` order by created_on DESC limit %d;",
		       mysql_real_escape_string($limit));
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

   function get_picture($picid)
   {
      $query = sprintf("SELECT pictures.id, pictures.title, pictures.filename, pictures.price, pictures.user_id, pictures.tag, users.login,  UNIX_TIMESTAMP(pictures.created_on) as created_on_unix from pictures, users where pictures.id = '%d' and pictures.user_id = users.id limit 1",
		       mysql_real_escape_string($picid));
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

   function get_purchased_pictures($userid)
   {
      $query = sprintf("SELECT pictures.id, pictures.filename from pictures, own where own.user_id = '%d' and pictures.id = own.picture_id;",
		       mysql_real_escape_string($userid));
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

   function create_picture($title, $width, $height, $tag, $filename, $price, $userid)
   {
      $high_quality_key = mt_rand(0, 10000000);
      $high_quality_key = base64_encode($high_quality_key);     
      $query = sprintf("INSERT INTO `pictures` (`id`, `title`, `width`, `height`, `tag`, `filename`, `price`, `high_quality`, `created_on`, `user_id`) VALUES (NULL, '%s', '%d', '%d', '%s', '%s', '%d', '%s', NOW(), '%d');",
		       mysql_real_escape_string($title),
		       mysql_real_escape_string($width),
		       mysql_real_escape_string($height),
		       mysql_real_escape_string($tag),
		       mysql_real_escape_string($filename),
		       mysql_real_escape_string($price),
		       mysql_real_escape_string($high_quality_key),
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


   
   function add_conflict($orig_filename, $new_filename, $new_tag, $new_name, $new_price, $user_id)
   {
      $query = sprintf("INSERT INTO `conflict_pictures` (`id`, `orig_filename`, `new_filename`, `new_tag`, `new_name`, `new_price`, `user_id`) VALUES (NULL, '%s', '%s', '%s', '%s', '%d', '%s');",
		       mysql_real_escape_string($orig_filename),
		       mysql_real_escape_string($new_filename),
		       mysql_real_escape_string($new_tag),
		       mysql_real_escape_string($new_name),
		       mysql_real_escape_string($new_price),
		       mysql_real_escape_string($user_id));
      if (mysql_query($query))
      {
	 return mysql_insert_id();
      }
      else
      {
	 return False;
      }
   }

   

   function delete_conflict($conflictid, $choice)
   {
      $to_ret = False;
      $query = sprintf("SELECT * from `conflict_pictures` where `id` = '%d' limit 1;",
		       mysql_real_escape_string($conflictid));
      if ($res = mysql_query($query))
      {
	 $conflict = mysql_fetch_assoc($res);
	 if ($choice == "first")
	 {
	    $to_ret = Pictures::create_picture($conflict['new_name'], 128, 128, $conflict['new_tag'], $conflict['orig_filename'] , $conflict['new_price'], $conflict['user_id']);
	 }
	 else
	 {
	    $to_ret = Pictures::create_picture($conflict['new_name'], 128, 128, $conflict['new_tag'], basename($conflict['new_filename']), $conflict['new_price'], $conflict['user_id']);	    
	 }
      }
      $query = sprintf("DELETE from `conflict_pictures` where `id` = '%d' limit 1;",
		       mysql_real_escape_string($conflictid));
      mysql_query($query);
      return $to_ret;
   }

   function get_conflict($conflictid, $userid)
   {
      $query = sprintf("SELECT * from `conflict_pictures` where `id` = '%d' and user_id = '%d' limit 1;",
		       mysql_real_escape_string($conflictid),
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

   function resize_image($source_pic, $destination_pic, $max_width, $max_height)
   {   
      $src = imagecreatefromjpeg($source_pic);
      list($width,$height)=getimagesize($source_pic);

      $x_ratio = $max_width / $width;
      $y_ratio = $max_height / $height;

      if( ($width <= $max_width) && ($height <= $max_height) )
      {
	 $tn_width = $width;
	 $tn_height = $height;
      }
      elseif (($x_ratio * $height) < $max_height)
      {
	 $tn_height = ceil($x_ratio * $height);
	 $tn_width = $max_width;
      }
      else
      {
	 $tn_width = ceil($y_ratio * $width);
	 $tn_height = $max_height;
      }

      $tmp=imagecreatetruecolor($tn_width,$tn_height);
      imagecopyresampled($tmp,$src,0,0,0,0,$tn_width, $tn_height,$width,$height);

      imagejpeg($tmp,$destination_pic,100);
      imagedestroy($src);
      imagedestroy($tmp);   
   }
}

?>