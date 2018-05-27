<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    if(!isset($_SESSION['loggedIn'])) {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $userInfo = getUserInfoByEmail($email);
        $passwordCheck = checkPassword($email, $password);
        $firstname = $userInfo['firstname'];
        
        if(isset($firstname) && $passwordCheck) {
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['firstname'] = $firstname;
            header('Location: ../dashboard.php');
        } else {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }
?>