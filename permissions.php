<?php
$config = array();
$config = include('config.php');
return [
    "exceptions" => array("PHP-Login/usermanagement.php",$config["homepage"]),
    "/PHP-Login/examplesite.php" => array("user1", "user2")
];