<?php
    // log user out by unsetting session variable called email, and destroying the session
    
    session_start();
    if (isset($_SESSION['Cemail'])) {
        unset($_SESSION['Cemail']);
    }
    session_destroy();
    
    // redirect user to login page
    header("Location: customerHomeForEdits.php");
    exit;
?>