<?php
    session_start();

    // removes all session variables
    session_unset();

    // destroys the session
    session_destroy();

    // redirects to the home page
    header('Location: ../index.php');
    exit;
?>