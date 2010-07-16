<?php

require_once("../include/pictures.php");
require_once("../include/comments.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

$pictures = Pictures::get_recent_pictures(10);

?>

<?php our_header("recent"); ?>

<div class="column prepend-1 span-24 first last">
<h2>Recently uploaded pictures</h2>


   <?php thumbnail_pic_list($pictures); ?>


</div>


<?php our_footer(); ?>

