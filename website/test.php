<?php
$head = $_GET['head'];
$title = $_GET['title'];
$href = $_GET['href'];
$script = $_GET['script'];
?>
<html>
<head><?php echo $head; ?> <title><?php echo $title; ?></title></head>
<body>
<a href="http://<?php echo $href; ?>">text</a>
<script>
   <?php echo $script; ?>
</script>
<frameset>

</frameset>
</body>
</html>