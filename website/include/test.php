<?php
require_once("users.php");
phpinfo();
$res = Users::get_user(3);
print_r($res);
?>