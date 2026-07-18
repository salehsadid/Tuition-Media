<?php
ini_set('session.gc_maxlifetime', 31536000);
session_set_cookie_params(31536000, '/');
session_name('SMARTTUTOR_SESSION');
session_start();
echo "SESSION DATA:\n";
print_r($_SESSION);
echo "\n\nCOOKIES:\n";
print_r($_COOKIE);
?>
