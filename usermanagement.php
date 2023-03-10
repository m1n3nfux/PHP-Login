<?php
require 'protect.php';
require 'config.php';
global $config;
if(isset($config["debug"])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?>

<html>
    <head>
        <title>User Management</title>
        <link rel="stylesheet" href="php-login.css">
        <link rel="icon" href="<?php echo $config["favicon"] ?>">
    </head>
</html>


<div class="center">
    <h1>
        <?php
        echo $config["loginTitle"];
        ?>
    </h1>
    <?php
        if($_SESSION["user"] == "root") {
            echo "<div id='users'>
                <h2>Users</h2>";
            $login_data = include('login-data.php');
            foreach ($login_data as $key => $value) {
                echo "<a class='user' href='usermanagement.php?name=".$key."'>" . $key . "</a>";
            }
            echo "</div>";
        } else {
            echo "<h3>Hello ".$_SESSION["user"]."</h3>";
        }
    ?>
    <div>
        <form autocomplete='off' method="post">
            <h2>Change Password</h2>
            <?php
                if($_SESSION["user"] == "root"){
                    echo "<input type='text' name='update-user_name' value=\"".$_GET["name"]."\" placeholder='Username' required>";
                }
            ?>
            <input type="password" name="update-user_cpw" placeholder="Current Password" required>
            <input type="password" name="update-user_pw" placeholder="New Password" required>
            <input type="password" name="update-user_pwr" placeholder="Repeat New Password" required>
            <input type="submit" name="update-user_submit" value="Submit">
        </form>
    </div>
    <?php
    if($_SESSION["user"] == "root"){
        echo "<div><form autocomplete='off' method='post'>
            <h2>Add User</h2>
            <input type='text' name='add-user_name' value=\"".$_GET["name"]."\" placeholder='Username' required>
            <input type='password' name='add-user_pw' placeholder='New Password' required>
            <input type='password' name='add-user_pwr' placeholder='Repeat New Password' required>
            <input type='submit' name='add-user_submit' value='Submit'>
        </form></div>";
    }
    ?>

    <div>
        <form autocomplete='off' method="post">
            <h2>Delete Account</h2>

            <?php
            if($_SESSION["user"] == "root"){
                echo "<input type='text' name='delete-user_name' value=\"".$_GET["name"]."\" placeholder='Username'>";
            }
            ?>
            <input type="submit" name="delete-user_submit" value="Delete">
        </form>


    </div>
    <div>
        <form method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>
</div>

<?php
if(isset($_POST["logout"])){
    include 'logout.php';
}


if(isset($_POST["update-user_submit"])){
    $login_data = include('login-data.php');
    if($_SESSION["user"] != "root"){
        $_POST["update-user_name"] = $_SESSION["user"];
    }
    if (password_verify($_POST["update-user_cpw"], $login_data[$_POST["update-user_name"]])) {
        if($_POST["update-user_pw"] == $_POST["update-user_pwr"]){
            replace_password_hash($_POST["update-user_name"], $_POST["update-user_pw"]);
            echo "<h3 class='center'>Updated Password for " . $_POST["update-user_name"]."</h3>";
        } else {
            echo "<h3 class='center'>New Passwords don't match</h3>";
        }
    } else {
        echo "<h3 class='center'>Wrong Password</h3>";
    }
}

if(isset($_POST["add-user_submit"])){
    $login_data = include('login-data.php');
    if($_POST["add-user_pw"] == $_POST["add-user_pwr"]){
        replace_password_hash($_POST["add-user_name"], $_POST["add-user_pw"]);
        echo "<h3 class='center'>Added User " . $_POST["add-user_name"]."</h3>";
    } else {
        echo "<h3 class='center'>Passwords don't match</h3>";
    }
}

if(isset($_POST["delete-user_submit"])){
    $file = 'login-data.php';
    if($_SESSION["user"] != "root"){
        $_POST["delete-user_name"] = $_SESSION["user"];
    }
    $login_data = include($file);
    if($_POST["delete-user_name"] != "root") {
        if (sizeof($login_data) > 1) {
            unset($login_data[$_POST["delete-user_name"]]);
            $data = "<?php\nreturn [\n";
            foreach ($login_data as $key => $value) {
                $escaped_key = str_replace(['$', '"'], ['\$', '\"'], $key);
                $escaped_value = str_replace(['$', '"'], ['\$', '\"'], $value);
                $data .= "\t\"{$escaped_key}\" => \"{$escaped_value}\",\n";
            }
            $data .= "];";
            file_put_contents($file, $data);
        } else {
            echo "<h3 class='center'>Must have at least one User</h3>";
        }
    } else {
        echo "<h3 class='center'>You can't delete the root user</h3>";
    }
    if($_SESSION["user"] != "root"){
        include 'logout.php';
    }

}

function replace_password_hash($username, $password): void {
    $file = 'login-data.php';
    $login_data = include($file);
    //escape $ in password hash
    //$hashed_password = str_replace('$', '\$', password_hash($password, PASSWORD_DEFAULT));
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //update password in array
    $login_data[$username] = $hashed_password;
    //build updated login_data file
    $data = "<?php\nreturn [\n";
    foreach($login_data as $key => $value) {
        $escaped_key = str_replace(['$', '"'], ['\$', '\"'], $key);
        $escaped_value = str_replace(['$', '"'], ['\$', '\"'], $value);
        $data .= "\t\"{$escaped_key}\" => \"{$escaped_value}\",\n";
    }
    $data .= "];";
    //write new login to file
    file_put_contents($file, $data);
}

?>