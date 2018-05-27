<?php
    session_start();

    if(isset($_SESSION['loggedIn'])) {
        unset($_SESSION['loggedIn']);
    }
    
    if(isset($_SESSION['firstname'])) {
        unset($_SESSION['firstname']);
    }

    if(isset($_SESSION['error'])) {
        unset($_SESSION['error']);
    }
    
    session_destroy();

    header('Location: ../index.php');
?>