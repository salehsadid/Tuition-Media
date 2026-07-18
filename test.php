<?php
require 'config/database.php';
$db = Database::getInstance();
try {
    $db->execute("SELECT * FROM ST_USER WHERE user_id = :uid", ['uid' => 1]);
    echo "SUCCESS";
} catch (Exception $e) {
    echo $e->getMessage();
}
