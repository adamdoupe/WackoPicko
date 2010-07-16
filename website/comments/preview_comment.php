<?php
require_once("../include/html_functions.php");
require_once("../include/comments.php");
require_once("../include/users.php");
require_once("../include/functions.php");
require_once("../include/pictures.php");

session_start();

require_login();

$error = False;
$previewid = 0;
$pic = 0;
if (isset($_POST['text']) && isset($_POST['picid']))
{
   $cur = Users::current_user();
   if (!($previewid = Comments::add_preview($_POST['text'], $cur['id'], $_POST['picid'])))
   {      
      $error = True;
   }
   else
   {
      if (!($pic = Pictures::get_picture($_POST['picid'])))
      {
	 $error = True;
      }
      else
      {
	 $error = False;
      }
   }
}
else
{
   $error = True;
}


if ($error)
{
   if (isset($_POST['picid']))
   {
      http_redirect(".." . Pictures::$VIEW_PIC_URL . "?picid=" . $_POST['picid']);
   }
   else
   {
      error_404();
   }
}

?>

<?php our_header(); ?>

<div class="column prepend-1 span-14 first" >
  <h2 id="image-title">A Preview of what your comment on <?=h( $pic['title'] )?> will look like </h2>
  <img id="image" src="../upload/<?=h( $pic['filename'] )?>.550.jpg" width="550" />
	
  <div class="column span-14 first last " id="comments">
    <div class="column span-14 first last">
      <h2 id="comment-title">Your Comment</h2>
    </div>
    <div class="column prepend-1 span-12 first last">
      <p class="comment"><?=h( $_POST['text'] )?></p>
    </div>
    <div class="column prepend-10 span-6 first last">
      - by <a href="<?= Users::$VIEW_URL ?>?userid=<?=h( $cur['id'] )?>"><?=h( $cur['login'] ) ?></a>
    </div>
    <form action="<?= Comments::$DELETE_PREVIEW_COMMENT_URL ?>" method="POST" style="display:inline">
    <input type="hidden" name="previewid" value="<?= h( $previewid ) ?>" />
    <input type="hidden" name="picid" value="<?= h( $_POST['picid'] ) ?>" />
    <input type="submit" value="Cancel" />      
    </form>
    <form action="<?= Comments::$ADD_COMMENT_URL; ?>" method="POST"style="display:inline">
    <input type="hidden" name="previewid" value="<?= h( $previewid ) ?>" />
    <input type="hidden" name="picid" value="<?= h( $_POST['picid'] ) ?>" />
    <input type="submit" value="Create" />
  </form>
  </div>
</div>




<?php our_footer(); ?>