<?php

session_start();
require __DIR__ . '/config.php';

if (isset($_POST["user"]) && !isset($_SESSION["user"])) {
    $login_data = include('login_data.php');

    if (isset($login_data[$_POST["user"]]) && password_verify($_POST["password"], $login_data[$_POST["user"]])) {
        $_SESSION["user"] = $_POST["user"];
    }


    if (!isset($_SESSION["user"])) {
        $failed = true;
    }
}


if (isset($_SESSION["user"])) {
    global $config;
    header("Location: ". $config["homepage"]);
    exit();
}