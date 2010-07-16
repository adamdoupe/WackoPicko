<?php

require_once("ourdb.php");

class Guestbook
{
   static public $GUESTBOOK_URL = "/guestbook.php";

   function get_all_guestbooks()
   {
      $query = sprintf("SELECT `id`, `name`, `comment`, `created_on` from `guestbook` ORDER BY created_on DESC;");
      $res = mysql_query($query);
      if ($res)
      {
	 while ($row = mysql_fetch_assoc($res))
	 {
	    $to_return[] = $row;
	 }
	 return $to_return;
      }
      else
      {
	 return False;
      }
   }

   function add_guestbook($name, $comment, $vuln = False)
   {
      if ($vuln)
      {
	 $query = sprintf("INSERT INTO `guestbook` (`id`, `name`, `comment`, `created_on`) VALUES (NULL, '%s', '%s', NOW());",
			  $name,
			  mysql_real_escape_string($comment));
      }
      else
      {
	 $query = sprintf("INSERT INTO `guestbook` (`id`, `name`, `comment`, `created_on`) VALUES (NULL, '%s', '%s', NOW());",
			  mysql_real_escape_string($name),
			  mysql_real_escape_string($comment));
      }
      return mysql_query($query);
   }
}
?>