<?php

require_once("../include/users.php");
require_once("../include/pictures.php");
require_once("../include/html_functions.php");
require_once("../include/functions.php");

session_start();

require_login();

$user = Users::current_user();

?>

<?php our_header("home"); ?>
<div class="column prepend-1 span-24 first last">
   <h2>Hello <?=h( $user['login'] )?>, you got <?=h($user['tradebux']) ?> Tradebuxs to spend!</h2>
<p>Cool stuff to do:</p>
<ul style="list-style-type:none;">
<li><a href="/users/similar.php">Who's got a similar name to you?</a></li>
<li><a href="<?= Users::$VIEW_URL ?>?userid=<?=h( $user['id'] ) ?>">Your Uploaded Pics</a></li>
<li><a href="/pictures/purchased.php">Your Purchased Pics</a></li>
</ul>
<p>
  Enter in our contest: <br/>
	    <OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
	    WIDTH="610"
	    HEIGHT="410"
	    CODEBASE="http://active.macromedia.com/flash5/cabs/swflash.cab#version=6,0,23,0">
	    <PARAM NAME="MOVIE" VALUE="/action.swf">
	    <PARAM NAME="PLAY" VALUE="true">
	    <PARAM NAME="LOOP" VALUE="true">

	    <PARAM NAME="QUALITY" VALUE="high">
	    <EMBED SRC="/action.swf" WIDTH="510" HEIGHT="410"
	    PLAY="true" ALIGN="" LOOP="true" QUALITY="high"
	    TYPE="application/x-shockwave-flash"
	    PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
	    </EMBED>
	    </OBJECT>
	  </p>
</div>

<?php our_footer(); ?>