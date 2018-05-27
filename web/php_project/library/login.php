<?php
    require 'library/connection.php';
    require 'library/functions.php';

    session_start();

    $sanEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $valUserEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);
    $user_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $firstname = getUserFirstNameByEmail($valUserEmail);
    $_SESSION['firstname'] = $firstname;
    
    header('Location: dashboard.php');
?>