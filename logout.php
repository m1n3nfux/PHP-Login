<?php
$_POST["logout"] = True;
require 'protect.php';
session_destroy();
unset($_SESSION);
header("Location: login.php");
?>