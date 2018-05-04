<?php
    session_start();
    $_SESSION['user'] = 'Tester';
    header('Location: home.php');
?>