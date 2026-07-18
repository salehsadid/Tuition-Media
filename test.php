<?php
function injectSessionName($filePath) {
    if (!file_exists($filePath)) return;
    $content = file_get_contents($filePath);
    
    // Check if session_name is already there
    if (strpos($content, "session_name('SMARTTUTOR_SESSION');") === false) {
        // Insert session_name before session_start
        $content = str_replace("session_start();", "session_name('SMARTTUTOR_SESSION');\n    session_start();", $content);
        file_put_contents($filePath, $content);
        echo "Updated $filePath\n";
    }
}

injectSessionName('pages/login.php');
injectSessionName('pages/admin-login.php');
injectSessionName('pages/register.php');
injectSessionName('pages/logout.php');
injectSessionName('includes/auth.php');
echo "Session name updated.";
?>
