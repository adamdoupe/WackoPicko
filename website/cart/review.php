<?php

require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/cart.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");


session_start();
require_login();

$user = Users::current_user();

$cart = Cart::get_cart($user['id']);

if ($cart)
{
   $items = Cart::cart_items($cart['id']);
   $coupons = Cart::cart_coupons($cart['id']);
}
our_header("cart");
?>
<div class="column prepend-1 span-22 first last">
  <h2>Welcome to your cart <?= h( $user['login'] ) ?></h2>
  <form action="<?=h( Cart::$ACTION_URL . '?action=delete' ); ?>" method="POST">
<?php if ($cart) { ?>
  <table>
    <tr>
      <th>Pic name</th> <th>Sample Pic</th> <th>Price</th> <th>Delete?</th>
    </tr>
    <?php foreach($items as $item) { ?>
    <tr>
      <td><?=h($item['title']); ?></td> <td><img src="../upload/<?=h( $item['filename'] );?>" alt="<?=h( $item['title'] );?>" height="<?=h( $item['height'] );?>" width="<?=h( $item['width'] );?>" /></td><td><?=h( $item['price'] );?> Tradebux</td> <td><input type="checkbox" value="<?=h( $item['picture_id'] );?>" name="pics[]" /> </td>
    </tr>
    <?php } ?>
  </table>			         
  <?php if ($coupons) { ?>
  <table>
    <tr>
      <th>Coupon Code</th> <th>Coupon Amount</th>
    </tr>
    <?php foreach($coupons as $coupon) { ?>
    <tr>
      <td><?=h($coupon['code']) ?></td><td><?=h( 100.0 - $coupon['discount']) ?>% Off</td>
    </tr>
    <?php } ?>
  </table>
  <?php } ?>
  <input type="submit" value="Remove From Cart" />
</form>
<form action="<?=h( Cart::$ACTION_URL . '?action=addcoupon' ) ?>" method="POST">
Enter Coupon Code: <input type="text" name="couponcode" /><br />
<input type="submit" value="Submit Coupon" />
</form>

<a href="<?=h( Cart::$CONFIRM_URL );?>">Continue to Confirmation</a>
<?php } 
else { ?>
<h2> You don't have a cart! </h2>
<p><a href="<?=h (Pictures::$RECENT_URL)?>">Go find some pictures!</a></p>
<?php } ?>
</div>
<?php
our_footer();
?>

