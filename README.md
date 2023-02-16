# PHP-Login
A drop-in Login Area entirely written in PHP. No Database needed.

Features:
- [X] **Stores Password as hashes**
- [X] Multiple Users
  - [X] each user can change their own password
  - [X] Users can delete their own account
  - [X] root user can change passwords of all users
  - [X] root user can add new users
  - [X] root user can delete every account
  - [X] Select which user can access which site
  - [X] root user can access every site 

Usage: 
- restrict access to login-data.php <sup>(thats where the password hasheds are stored)</sup> <br>For example with `.htaccess` like this:
```
<Files "path/to/login-data.php">  
  Require all denied
</Files>
```
- Change config.php to your liking. Successful Login will redirect to `homepage`. 
- Add `<?php require 'protect.php'; ?>` to the Sites you want to secure
- To set permissions, add the relative path of sites with the line above to `permissions.php` like this: 
  - `"/relative/path/site.php" => array("user1", "user2")`. 
  - `exceptions` will be accessible for every logged-in user. 
  - The `root` user can access every protected site.
  - **Note: Depending on where you pull the Repo, you might need to change the path of `usermanagement.php`. Do NOT remove it from the exeptions**
- Onboarding:
  - navigate to `login.php`
  - login with username `root` and password `root`
  - navigate to `usermanagement.php`
  - change root password & add other users
  - ...
  - Profit!
  
Feel free to create a better css file and create a pull request :)
