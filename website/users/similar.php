<?php

require_once("../include/users.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();
require_login();

$user = Users::current_user();

$similar_usernames = Users::similar_login($user['firstname'], True);

?>

<?php our_header() ; ?>

<div class="column prepend-1 span-24 first last">
<h2> Users with similar names to you, <?=h( $user['firstname'] )?> </h2>
<ul>
   <?php if ( $similar_usernames ) { ?>
   <?php foreach( $similar_usernames as $u ) { ?>

					       <li><a href="<?=h( Users::$VIEW_URL . "?userid=" . $u['id'] )?>"><?=h( $u['login'] ) ;?></a></li>

   <?php } ?>
   <?php }
    else { ?>

   <p> No one with a similar username. Lucky you! </p>

   <?php } ?>
</ul>
</div>

<?php our_footer() ; ?>