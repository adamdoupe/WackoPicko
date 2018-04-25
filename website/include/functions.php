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

function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

?>