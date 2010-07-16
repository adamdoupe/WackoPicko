<?php

require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

require_login();

if (!isset($_GET['conflictid']))
{
   error_404();
}

$user = Users::current_user();
$conflict = Pictures::get_conflict($_GET['conflictid'], $user['id']);

$filename = "";

if (isset($_GET['first']))
{
   $filename = $conflict['orig_filename'];
}
elseif (isset($_GET['second']))
{
   $filename = $conflict['new_filename'];
}

header("Content-type: " . mime_content_type($filename));
passthru("cat $filename");

?>