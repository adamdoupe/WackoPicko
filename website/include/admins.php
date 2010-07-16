<?php

require_once("ourdb.php");

class Admins
{
   static public $HOME_URL = "/admin/index.php?page=home";
   static public $LOGIN_URL = "/admin/index.php?page=login";
   static public $CREATE_URL = "/admin/index.php?page=create";
   static public $cur_admin = False;

   function get_admin_id($adminid)
   {
      $query = sprintf("SELECT * from admin where id = '%d'",
		       mysql_real_escape_string($userid));
      $res = mysql_query($query);
      if ($res)
      {
	 return mysql_fetch_assoc($res);
      }
      else
      {
	 return False;
      }
   }

   function get_admin_session($sessid)
   {
      $query = sprintf("SELECT admin.id, admin.login, admin.password from admin, admin_session where admin_session.id = '%s' and admin_session.admin_id = admin.id limit 1;",
		       mysql_real_escape_string($sessid));
      $res = mysql_query($query);
      if ($res)
      {
	 return mysql_fetch_assoc($res);
      }
      else
      {
	 return False;
      }
   }

   function create_admin($login, $pass)
   {
      $query = sprintf("INSERT into `admin` (`id`, `login`, `password`) VALUES (NULL, '%s', SHA1('%s'));",
		       mysql_real_escape_string($login),
		       mysql_real_escape_string($pass));
      if ($res = mysql_query($query))
      {
	 return mysql_insert_id();
      }
      else
      {
	 return False;
      }
   }

   function login_admin($adminid)
   {
      // Don't trust the php session, we're using our own
      $query = sprintf("INSERT into `admin_session` (`id`, `admin_id`, `created_on`) VALUES (NULL, '%s', NOW());",
		       mysql_real_escape_string($adminid));
      if ($res = mysql_query($query))
      {
	 // add the cookie
	 $id = mysql_insert_id();
	 setcookie("session", $id);
	 return mysql_insert_id();
      }
      else
      {
	 return False;
      }
   }
   function clean_admin_session()
   {
      mysql_query("DELETE from admin_session WHERE created_on < DATE_SUB( NOW(), INTERVAL 1 HOUR );");
   }

   function check_login($admin, $pass)
   {
      $query = sprintf("SELECT * from `admin` where `login` like '%s' and `password` = SHA1( '%s' ) limit 1;",
		       mysql_real_escape_string($admin),
		       mysql_real_escape_string($pass));
      $res = mysql_query($query);
      if ($res)
      {
	 return mysql_fetch_assoc($res);
      }
      else
      {
	 return False;
      }
   }

   function current_admin()
   {
      if (isset($_COOKIE['session']))
      {
	 if (!$cur_admin)
	 {
	    Admins::clean_admin_session();
	    $cur_user = Admins::get_admin_session($_COOKIE['session']);
	 }
	 return $cur_user;
      }
      else
      {
	 return False;
      }
   }

   function is_logged_in()
   {
      if (Admins::current_admin())
      {
	 return true;
      }
      else
      {
	 return False;
      }
   }
   


}

?>