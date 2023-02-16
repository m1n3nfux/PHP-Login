<?php
session_start();

if (isset($_POST["logout"])) {
    session_destroy();
    unset($_SESSION);
}

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
} else {
    $permissions = include "permissions.php";
    if($_SESSION['user'] != "root" && in_array($_SERVER['REQUEST_URI'],$permissions["exceptions"])){
        if(!in_array($_SESSION['user'],$permissions[$_SERVER['REQUEST_URI']])){
            header("Location: error.php?url=".$_SERVER['REQUEST_URI']);
        }
    }
}