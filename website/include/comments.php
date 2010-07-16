<?php

require_once("ourdb.php");

class Comments
{
   static public $ADD_COMMENT_URL = "/comments/add_comment.php";
   static public $PREVIEW_COMMENT_URL = "/comments/preview_comment.php";
   static public $DELETE_PREVIEW_COMMENT_URL = "/comments/delete_preview_comment.php";

   function add_preview($text, $userid, $pictureid)
   {
      $query = sprintf("INSERT INTO `comments_preview` (`id`, `text`, `user_id`, `picture_id`, `created_on`) VALUES (NULL, '%s', '%d', '%d', NOW());",
		       mysql_real_escape_string($text),
		       mysql_real_escape_string($userid),
		       mysql_real_escape_string($pictureid));
      mysql_query($query);
      return mysql_insert_id();
   }

   function get_all_comments_picture($picid)
   {
      $query = sprintf("SELECT `comments`.`user_id` , `comments`.`text` , `comments`.`created_on` , `users`.`login` FROM `comments` , `users` WHERE `picture_id` = '%d' AND `users`.`id` = `comments`.`user_id` ORDER BY created_on DESC;",
		       mysql_real_escape_string($picid));
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

   function delete_preview($previewid, $userid)
   {
      $query = sprintf("DELETE from `comments_preview` where id = '%d' and user_id = '%d'",
                        mysql_real_escape_string($previewid),
                        mysql_real_escape_string($userid));
      return mysql_query($query);
   }

   function add_comment($previewid, $userid)
   {     
      mysql_query("BEGIN;");
      $query = sprintf("SELECT `user_id`, `text`, `picture_id`, `created_on` from `comments_preview` where `id` = '%d' and `user_id` = '%d' LIMIT 1;",
                        mysql_real_escape_string($previewid),
                        mysql_real_escape_string($userid));
      $res = mysql_query($query);
      if (!$res)
      {
	 mysql_query("ROLLBACK;");
	 return False;
      }
      $preview = mysql_fetch_assoc($res);

      $query = sprintf("INSERT INTO `comments` (`id`, `text`, `user_id`, `picture_id`, `created_on`) VALUES (NULL, '%s', '%d', '%d', '%s');",
		       mysql_real_escape_string($preview['text']),
		       mysql_real_escape_string($preview['user_id']),
		       mysql_real_escape_string($preview['picture_id']),
                       mysql_real_escape_string($preview['created_on']));
                       
      if (!mysql_query($query))
      {
	 mysql_query("ROLLBACK;");
	 return False;
      }

      $query = sprintf("DELETE from `comments_preview` where id = '%d'",
                        mysql_real_escape_string($preview['id']));
      if (!mysql_query($query))
      {
	 mysql_query("ROLLBACK;");
	 return False;
      }
      return mysql_query("COMMIT;");
      
   }

   

}

?>