<?php
/**
 * Root Redirect
 * Forwards requests from the root domain to the pages directory.
 */
header("Location: pages/index.php");
exit();
