<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$_SESSION["userid"] = NULL;
$_SESSION["username"] = NULL;
$_SESSION["userpic"] = NULL;

//Redirect to our site home page, which we call home.php
header('Location: ../../home.php');
exit;

?>