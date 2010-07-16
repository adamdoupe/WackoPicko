<?php

require_once("users.php");

function http_redirect($url)
{
   header("Location: {$url}", True, 303);
   exit(0);
}

function error_404()
{
   header("HTTP/1.1 404 Not Found", True, 404);
   exit(0);
}

function require_login()
{
   session_start();
   if (!Users::is_logged_in())
   {
      http_redirect(Users::$LOGIN_URL);
   }
}

function require_admin_login()
{
   if (!Admins::is_logged_in())
   {
      http_redirect(Admins::$LOGIN_URL);
   }
}

function h ($str)
{
   return htmlspecialchars($str);
}

?>