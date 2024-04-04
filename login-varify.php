<?php
$email = $_POST['email'];
$password = $_POST['password'];
setcookie("email", $email, time() + 60*60*24*365, "/");
header("Location: ./");
?>