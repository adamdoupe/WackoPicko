<?php

$username = "wackopicko";
$pass = "webvuln!@#";
$database = "wackopicko";

// Setting to control what directory WackoPicko lives in.
$DIRECTORY = "/";


require_once("database.php");
$db = new DB("localhost", $username, $pass, $database);


?>