<?php
require "check.php";
require __DIR__ . '/config.php';


?>

<head>
    <link rel="stylesheet" href="login-styles.css">
    <title><?php global $config; echo $config["loginTitle"] ?></title>
</head>

<body>
<h1>
    <?php
        global $config;
        echo $config["loginTitle"];
    ?>
</h1>
<div class="center">
    <form id="login-form" method="post" target="_self">
        <input type="text" name="user" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
    <?php
    if (isset($failed)) { ?>
    <div id="badLogin">Invalid user or password.</div>
    <?php } ?>
</div>
</body>