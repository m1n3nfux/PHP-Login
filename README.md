# PHP-Login
A drop-in Login Area written in PHP.

Features:
- [X] Stores Password as hashes
- [X] Set permissions for users
- [X] Password reset
- [X] Add User
- [X] Delete User

Usage: 
- Pull Repo
- Change config.php to your liking. Successful Login will redirect to `homepage`. 
- Change `permission.php` to set which user can access which site. `exceptions` will be accessible for every logged-in user. 
  - **Note: Depending on where you pull the Repo, you might need to change the path of `usermanagement.php`. Do NOT remove it from the exeptions**
- add ```<?php require 'protect.php'; ?>``` to the Websites you want to secure
- add the relative path of sites with the line above to `permissions.php` like the example shows. The `root` user can access every protected site.
- ...
- Profit!
