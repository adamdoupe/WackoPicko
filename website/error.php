<?php

require_once("include/html_functions.php");

$message = $_GET['msg'];


our_header();
?>
<div class="column prepend-1 span-22 first last">
<h2>There was an error!</h2>

   <p class="error" style="text-align:center;"><?=h( $message )?></p>

</div>

<?php

our_footer();

?>