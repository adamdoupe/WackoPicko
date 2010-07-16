<?php

require_once("users.php");
require_once("functions.php");
session_start();

function our_header($selected = "", $search_terms = "")
{
   
   ?>
<html>
  <head>
    <link rel="stylesheet" href="/css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="/css/blueprint/print.css" type="text/css" media="print"> 
    <!--[if IE]><link rel="stylesheet" href="/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <link rel="stylesheet" href="/css/stylings.css" type="text/css" media="screen">
    <title>WackoPicko.com</title>
  </head>
  <body>
    <div class="container " style="border: 2px solid #5c95cf;">
      <div class="column span-24 first last">
	<h1 id="title"><a href="/">WackoPicko.com</a></h1>
      </div>
      <div id="menu">
	<div class="column prepend-1 span-14 first">
	  <ul class="menu">
	    <li class="<?php if($selected == "home"){ echo 'current'; } ?>"><a href="/users/home.php"><span>Home</span></a></li>
	    <li class="<?php if($selected == "upload"){ echo 'current'; } ?>"><a href="/pictures/upload.php"><span>Upload</span></a></li>
	    <li class="<?php if($selected == "recent"){ echo 'current'; } ?>"><a href="/pictures/recent.php"><span>Recent</span></a></li>
            <li class="<?php if($selected == "guestbook"){ echo 'current'; } ?>"><a href="/guestbook.php"><span>Guestbook</span></a></li>
      
      <?php if (Users::is_logged_in()) { ?><li class="<?php if($selected == "cart"){ echo 'current'; } ?>"><a href="/cart/review.php"><span>Cart</span></a></li> <?php } ?>
	  </ul>
	</div>
	<div class="column prepend-1 span-7 first last">
	  <ul class="menu top_login" >
      <?php if (Users::is_logged_in()){ ?>
	    <li><a href="/users/logout.php"><Span>Logout</span></a></li>
      <?php } else { ?>
	    <li><a href="/users/login.php"><Span>Login</span></a></li>
      <?php } ?>
	  </ul>
	</div>
      </div>
      
      
      
      <div class="column span-24 first last" id="search_bar_blue">
	<div class="column prepend-17 span-7 first last" id="search_box">
	  <form action="/pictures/search.php" method="get" style="display:inline;">
	    <input id="query2" name="query" size="15" style="padding: 2px; font-size: 16px; text-decoration:none;border:none;vertical-align:middle;" type="text" value="<?=h($search_terms) ?>"/>
	    <input src="/images/search_button_white.gif" type="image" style="border: 0pt none ; position: relative; top: 0px;vertical-align:middle;margin-left: 1em;" />
	  </form>
	</div>
      </div>
   <?php
}

function error_message()
{
   global $flash;
   if ($flash['error'])
   {
      ?>
<p class="span-10 error">
	 <?= h($flash['error']) ?>
</p>

      <?
   }
}

function our_footer()
{
   ?>
       <div class="column span-24 first last" id="footer" >
	<ul>
	  <li><a href="/">Home</a> |</li>
          <li><a href="/admin/index.php?page=login">Admin</a> |</li>
	  <li><a href="mailto:contact@wackopicko.com">Contact</a> |</li>
	  <li><a href="/tos.php">Terms of Service</a></li>
	</ul>
      </div>
    </div>
  </body>
</html>  
   <?php

}

function thumbnail_pic_list($pictures, $link_to = False)
{
   if (!$link_to)
   {
      $link_to = Pictures::$VIEW_PIC_URL."?";
   }
   ?>
<div class="column prepend-1 span-21 first last" style="margin-bottom: 2em;">
      <?php if ($pictures) { ?>
<ul class="thumbnail-pic-list">
<?php

   for ($i = 0; $i < count($pictures); $i++)
   {
      $pic = $pictures[$i];
      if ($i != 0 && (($i % 4) == 0))
      {
	 ?>
</ul>
</div>
<div class="column prepend-1 span-21 first last" style="margin-bottom: 2em;">
<ul class="thumbnail-pic-list">
	 <?php
      }

?>
<li>
<a href="<?=h( $link_to . "picid=" . $pic['id'] ) ?>"><img src="/upload/<?=h( $pic['filename']) ?>.128_128.jpg" height="128" width="128" /></a>
</li>
<?php

   }
?>
<?php }
   else { ?>
<h3 class="error">No pictures here...</h3>


<?php } ?>
</ul>
</div>
<?php
}

function high_quality_item_link($item)
{
   $name = h($_SERVER['SERVER_NAME']);
   $link = "http://{$name}/pictures/highquality.php?picid={$item['id']}&key=highquality";
   return "<a href='{$link}'>{$link}</a>"; 
}


?>