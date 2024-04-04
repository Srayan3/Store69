<?php
$username = $_POST['uname'];
$password = $_POST['pass'];
setcookie("username", $username, time() + 60*60*24*365, "/");
setcookie("password", $password, time() + 60*60*24*365, "/");
header("Location: index")
?>