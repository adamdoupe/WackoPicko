<?php

require_once("../include/admins.php");
require_once("../include/functions.php");

require_admin_login();
$admin = Admins::current_admin();

?>

<h2>Welcome to the awesome admin panel <?=h( $admin['login']) ?> </h2>

<a href="<?=h( Admins::$CREATE_URL )?>">Create a new user!</a>

