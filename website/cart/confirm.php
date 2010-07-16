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

if (!$cart)
{
   http_redirect("/error.php?msg=You do not have a cart");
}

$items = Cart::cart_items($cart['id']);
$total = Cart::cart_total($cart['id']);
$has_enough = $user['tradebux'];

our_header("cart");
?>

<div class="column prepend-1 span-22 first last">
<h2>Confirm your purchase <?=h( $user['login'] ) ;?></h2>

<form action="<?=h( Cart::$ACTION_URL . '?action=purchase' ); ?>" method="POST">
<table>
<tr>
<th>Pic name</th><th>High Quality Link</th><th>Price</th>
</tr>
   <?php foreach($items as $item) { ?>
    <tr><td><?=h($item['title']); ?></td> <td><?= high_quality_item_link($item); ?></td><td><?=h( $item['price'] );?> Tradebux</td></tr>

   <?php } ?>
</table>

<p>Total : <b><?= $total ?> Tradebux</b></p>

   <?php if ($has_enough) { ?>
<input type="submit" value="Purchase" />
			    <?php }
else { ?>

   <p>You do not have enough tradebux to purchase this cart. <a href="<?=h( Cart::$REVIEW_URL ); ?>">Go back</a> and remove some items</p>

<?php
}
?>


</form>
</div>

<?php

our_footer();

?>
