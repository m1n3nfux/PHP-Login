<?php
echo "Error: insufficient permissions to visit ".$_SERVER['HTTP_HOST'].$_GET["url"];
?>
<a href="logout.php">Logout</a>