<?php
    session_start();
    $_SESSION['user'] = 'Tester';
    // include 'home.php';
    header('Location: home.php');
?>