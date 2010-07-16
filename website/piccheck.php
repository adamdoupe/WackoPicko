<?php
require_once("include/html_functions.php");
require_once("include/functions.php");

if (!isset($_FILES['userfile']) && !isset($_POST['name']))
{
   http_redirect("/");
}


$type = $_FILES['userfile']['type'];
$name = $_POST['name'];

?>

<?php our_header("home"); ?>


<div class="column prepend-1 span-24 first last">
  <h2>Checking your file <?= $name ?></h2>
  <p>
    File is O.K. to upload!
  </p>
</div>


<?php our_footer(); ?>
