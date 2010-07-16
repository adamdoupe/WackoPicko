<?php

require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

require_login();
$user = Users::current_user();
if (!isset($_GET['conflictid']))
{
   error_404();
}
$conflict = Pictures::get_conflict($_GET['conflictid'], $user['id']);

if (!$conflict)
{
   error_404();
}

if(isset($_POST['choice']))
{
   $id = Pictures::delete_conflict($_GET['conflictid'], $_POST['choice'][0]);
   http_redirect(Pictures::$VIEW_PIC_URL . "?picid=" . $id);   
}


our_header();
?>
<div class="column prepend-1 span-24 first last">
<h2>Choose the proper picture</h2>

<form action="<?=h( $_SERVER['PHP_SELF'] )?>?conflictid=<?= $conflict['id'] ?>" method="POST">
 <img src="conflictview.php?conflictid=<?=h( $conflict['id'] ) ?>&first" /> <input type="radio" value="first" name="choice[]" /><br>
 <img src="conflictview.php?conflictid=<?=h( $conflict['id'] ) ?>&second" /> <input type="radio" value="second" name="choice[]" /><br> 
  <input type="submit" value="Choose Conflict" /><br>
</form>
</div>

<?php
   our_footer();
?>