<?php
require 'config/database.php';
$db = Database::getInstance();
$errors = $db->fetchAll("SELECT * FROM user_errors WHERE name = 'TRG_NOTIFY_ADMIN_ON_USER'");
print_r($errors);
