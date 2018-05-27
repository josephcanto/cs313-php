<?php
    require 'library/connection.php';
    require 'library/functions.php';

    session_start();

    if(!isset($_SESSION['loggedIn'])) {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $firstname = getUserFirstNameByEmail($email);
        $passwordCheck = checkPassword($password);
    
        if(isset($firstname) && $passwordCheck) {
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['firstname'] = $firstname;
            header('Location: dashboard.php');
        } else {
            header('Location: index.php');
        }
    }
?>