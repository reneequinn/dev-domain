<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['loggedIn']);
session_destroy();
header('Location: login.php');
exit;
?>