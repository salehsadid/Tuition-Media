<?php
require 'config/database.php';
$db = Database::getInstance();
$tables = ['ST_USER', 'ST_STUDENT', 'ST_TUTOR', 'ST_ADMIN', 'ST_TUITION_POST', 'ST_APPLICATION', 'ST_LOCATION', 'ST_SUBJECT'];

foreach ($tables as $table) {
    echo "TABLE: $table\n";
    $cols = $db->fetchAll("SELECT column_name FROM user_tab_columns WHERE table_name = :tname", ['tname' => $table]);
    foreach ($cols as $col) {
        echo " - " . $col['column_name'] . "\n";
    }
    echo "\n";
}
?>
