# PHP-Login
A drop-in Login Area written in PHP.

Features:
- [X] Stores Password as hashes
- [X] each user can change their password
- [X] root user can change passwords of all users
- [X] root user can add new users
- [X] Users can delete their own account
- [X] root user can delete every account

Usage: 
- Pull Repo
- Change config.php to your liking
- restrict access to login-data.php in your `.htaccess`
- navigate to `usermanagement.php`
- login with user name `root` and password `root`
- change root password & add other users
- add `<?php require 'protect.php'; ?>` to the Websites you want to secure
- ...
- Profit!
