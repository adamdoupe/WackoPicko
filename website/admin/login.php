<?php

require_once("../include/admins.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

$bad_login = !(isset($_POST['adminname']) && isset($_POST['password']));
if (isset($_POST['adminname']) && isset($_POST['password']))
{
   if ($user = Admins::check_login($_POST['adminname'], $_POST['password']))
   {
      Admins::login_admin($user['id']);
      http_redirect(Admins::$HOME_URL);
   }
   else
   {
      $bad_login = True;
   }
}

if ($bad_login)
{
?>

   <h2>Admin Area</h2>
  <form action="<?= Admins::$LOGIN_URL ?>" method="POST">
       Username : <input type="text" name="adminname" /><br>
       Password : <input type="password" name="password" /><br>
       <input type="submit" value="submit" />
   </form>
<?php
      }

?>