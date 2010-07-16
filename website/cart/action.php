<?php

require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/cart.php");
require_once("../include/functions.php");

// This page will do the fun stuff of adding to cart, deleting from cart or deleting a whole cart
session_start();
require_login();

$user = Users::current_user();
$cart = Cart::get_cart($user['id']);

if(!isset($_GET['action']))
{
   error_404();
}

if($_GET['action'] == "add")
{
   if (!isset($_GET['picid']))
   {
      error_404();
   }
   if (!$cart)
   {
      // need to create cart
      $cart['id'] = Cart::create_cart($user['id']);
   }
   if (!Cart::add_to_cart($cart['id'], $_GET['picid']))
   {
      http_redirect("/error.php?msg=Unable to add to cart at this time. Sorry.");
   }
   else
   {
      http_redirect(Cart::$REVIEW_URL);
   }
}
elseif( $_GET['action'] == "purchase" )
{
   if ($cart)
   {
      if ($user['tradebux'] >= Cart::cart_total($cart['id']))
      {
	 if( Cart::purchase($cart) )
	 {
	    http_redirect(Users::$PURCHASED_URL);
	 }
	 else
	 {
	    http_redirect("/error.php?msg=Unable to purchase your cart at this time. Try again later");
	 }
      }
      else
      {
	 http_redirect("/error.php?msg=You don't have enough money to purchase. Remove some items from <a href='" . Cart::$REVIEW_URL . "'>Your Cart</a>");
      }
   }
   else
   {
      http_redirect("/error.php?msg=You have no cart, nothing to purchase!");
   }
}
elseif( $_GET['action'] == "delete" )
{
   if ($cart)
   {
      if ($_POST['pics'])
      {
	 foreach($_POST['pics'] as $picid)
	 {
	    Cart::delete_from_cart($cart['id'], $picid);
	 }
	 $cart = Cart::get_cart($user['id']);
	 if (! Cart::cart_items($cart['id']))
	 {
	    Cart::delete_cart($cart['id'], False);
	    http_redirect(Users::$HOME_URL);
	 }

      }
      http_redirect(Cart::$REVIEW_URL);
   }
   else
   {
      http_redirect("/error.php?msg=You have no cart, nothing to delete!");
   }
}
elseif( $_GET['action'] == "deletecart" )
{
   if ($cart)
   {
      Cart::delete_cart($cart['id'], False);
   }
   http_redirect(Users::$HOME_URL);
}
elseif( $_GET['action'] == "addcoupon" )
{
   if ($cart)
   {
      if (isset($_POST['couponcode']))
      {
	 Cart::add_coupon($cart['id'], $_POST['couponcode']);
      }
      http_redirect(Cart::$REVIEW_URL);
   }
   else
   {
      http_redirect(Users::$HOME_URL);      
   }

}
else
{
   error_404();
}


?>