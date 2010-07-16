<?php
require_once("../include/html_functions.php");

if (!isset($_GET["password"])) // ?password=blah
{
   error_404();
}
$pass = $_GET["password"];


exec("/bin/cat /usr/share/dict/words | grep " . $pass, $output, $status);

if ($status == 0)
{
   $strong = False;
}
else
{
   $string = True;
}


?>

<?php our_header("home"); ?>

<div class="column prepend-1 span-24 first last">
<h2>Password Strength</h2>
<p>
   <?php if ($strong) { ?>
   <h3>You have chosen a strong password.</h3>
   <?php } else { ?>
   <h3>You have chosen a weak password.</h3>
   <?php } ?>
    
</p>
</div>