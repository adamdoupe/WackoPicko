<?php

require_once("include/html_functions.php");
$checked = false;
$ret = 0;
if (isset($_POST['password']))
{
   // check the password strength
   $pass = $_POST['password'];
   $command = "grep ^$pass$ /etc/dictionaries-common/words";
   exec($command, $output, $ret);   
   $checked = true;
}

?>

<?php our_header("home"); ?>


<div class="column prepend-1 span-24 first last">
<h2>Check your password strength</h2>
<?php if ($checked) { ?>
<p>
The command "<?= h($command) ?>" was used to check if the password was in the dictionary.<br /> 
<?= h( $pass ) ?> is a 
<?php if ($ret == 1) { ?>
    Good							       
<?php }
else { ?>
    Bad
<?php } ?>
Password
</p>
<?php }
?>
<form action="<?=h( $_SERVER['PHP_SELF'] )?>" method="POST">
   Password to check: <br>
   <input type="password" name="password" /><br>
   <input type="submit" value="Check!" />
</form>



</div>


<?php our_footer(); ?>