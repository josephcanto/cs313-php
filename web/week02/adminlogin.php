<?php
    session_start();
    $_SESSION['user'] = 'Administrator';
    header('Location: home.php');
?>