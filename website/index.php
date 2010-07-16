<?php

require_once("include/html_functions.php");

?>

<?php our_header("home"); ?>


<div class="column prepend-1 span-24 first last">
  <h2>Welcome to WackoPicko</h2>
  <p>
    On WackoPicko, you can share all your crazy pics with your friends. <br />
    But that's not all, you can also buy the rights to the high quality <br />
    version of someone's pictures. WackoPicko is fun for the whole family.
  </p>

  <h3>New Here?</h3>
  <p>
    <h4><a href="/users/register.php">Create an account</a></h4>
  </p>
  <p>
    <h4><a href="/users/sample.php?userid=1">Check out a sample user!</a></h4>
  </p>
  <p>
    <h4><a href="/calendar.php">What is going on today?</a></h4>
  </p>
  <p>
    <h4>Or you can test to see if WackoPicko can handle a file:</h4> <br />
  <script>
    document.write('<form enctype="multipart/form-data" action="/pic' + 'check' + '.php" method="POST"><input type="hidden" name="MAX_FILE_SIZE" value="30000" />Check this file: <input name="userfile" type="file" /> <br />With this name: <input name="name" type="text" /> <br /> <br /><input type="submit" value="Send File" /><br /> </form>');
  </script>
  </p>
</div>


<?php our_footer(); ?>
