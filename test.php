<?php
$sidebars = [
    'includes/student-sidebar.php',
    'includes/tutor-sidebar.php',
    'includes/admin-sidebar.php'
];

foreach ($sidebars as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        $content = preg_replace(
            "/<a href=\"\/pages\/index\.php\" class=\"sidebar-link\" style=\"color:rgba\(248,113,113,0\.8\);\">\s*Logout\s*<\/a>/",
            "<a href=\"../logout.php\" class=\"sidebar-link\" style=\"color:rgba(248,113,113,0.8);\">\n                   Logout\n                </a>",
            $content
        );

        file_put_contents($file, $content);
        echo "Updated $file\n";
    }
}
?>
