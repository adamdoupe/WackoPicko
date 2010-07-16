<?php

require_once("../include/users.php");
require_once("../include/functions.php");

session_start();
require_login();

Users::logout();

http_redirect("/");


?>