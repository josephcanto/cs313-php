<?php
    session_start();
    $_SESSION['user'] = 'Administrator';
    // include 'home.php';
    header('Location: home.php');
?>