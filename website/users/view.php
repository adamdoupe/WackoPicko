<?php
require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

if (!isset($usercheck))
{
   $usercheck = True;
}

if ($usercheck)
{
   require_login();
}

if(!isset($_GET['userid']))
{
   error_404();
}

$user = Users::get_user($_GET['userid']);
if (!$user)
{
   error_404();
}

$pictures = Pictures::get_all_pictures_by_user($_GET['userid']);

?>


<?php our_header(""); ?>
<div class="column prepend-1 span-24 first last">
   <?php if ($pictures) { ?>
<h2>These are <?=h( $user['login'] )?>&#39;s Pictures: </h2>   

<?php   thumbnail_pic_list($pictures); ?>

</div>
<?php
}
else { ?>
   <h2><?=h( $user['login'] ) ?> doesn&#39;t have any pictures yet. </h2>
<?php

      } ?>

<?php our_footer(); ?>
