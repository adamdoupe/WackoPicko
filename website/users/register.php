<?php

require_once("../include/users.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

$error = False;
if (isset($_POST['firstname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['againpass']) && isset($_POST['lastname'])
    && $_POST['username'] && $_POST['password'] && $_POST['againpass'] && $_POST['firstname'] && $_POST['lastname'])
{
   if ($_POST['password'] != $_POST['againpass'])
   {
      $flash['error'] = "The passwords do not match. Try again";
      $error = True;
   }
   else if ($new_id = Users::create_user($_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], False))
   {
      Users::login_user($new_id);
      http_redirect(Users::$HOME_URL);
   }
   else
   {
      if (mysql_errno() == 1062)
      {
	 $flash['error'] = "Username '{$_POST['username']}' is already in use.";
      }
      $error = True;
   }
}
else
{
   $flash['error'] = "All fields are required";
   $error = True;
}

if ($error)
{
   our_header();
   ?>
<div class="column prepend-1 span-24 first last" >
<h2> Register for an account!</h2>
<p>
Protect yourself from hackers and <a href="/passcheck.php">check your password strength</a>
</p>
<?php error_message() ?>
<table cellspacing="0" style="width:320px">
  <form action="<?=h( $_SERVER['PHP_SELF'] )?>" method="POST">
  <tr><td>Username :</td><td> <input type="text" name="username" /></td></tr>
  <tr><td>First Name :</td><td> <input type="text" name="firstname" /></td></tr>
  <tr><td>Last Name :</td><td> <input type="text" name="lastname" /></td></tr>
  <tr><td>Password :</td><td> <input type="password" name="password" /></td></tr>
  <tr><td>Password again :</td><td> <input type="password" name="againpass" /></td></tr>
  <tr><td><input type="submit" value="Create Account!" /></td><td></td></tr>
</form>
</table>
</div>



<?php
     our_footer();
}

?>