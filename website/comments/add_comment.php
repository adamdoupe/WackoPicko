<?php

require_once("../include/comments.php");
require_once("../include/users.php");
require_once("../include/functions.php");
require_once("../include/pictures.php");

session_start();

require_login();

$error = False;
if (isset($_POST['previewid']) && isset($_POST['picid']))
{
   $cur = Users::current_user();
   if (!Comments::add_comment($_POST['previewid'], $cur['id']))
   {
      $error = True;
   }
   else
   {
      http_redirect(".." . Pictures::$VIEW_PIC_URL . "?picid=" . $_POST['picid']);      
   }
}
else
{
   $error = True;
}


if ($error)
{
   if (isset($_POST['previewid']))
   {
      http_redirect(".." . Pictures::$VIEW_PIC_URL . "?picid=" . $_POST['picid']);
   }
   else
   {
      error_404();
   }
}

?>