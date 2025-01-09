<?php
// connection close and session destroied.
require('connection.php');

session_start();
session_unset();
session_destroy();

setcookie("user_id", "", time() - 3600, "/");
setcookie("user_name", "", time() - 3600, "/");

header("location: login.php");
exit();

?>