<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    if(!isset($_SESSION['loggedIn'])) {
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $sanUserEmail = filter_input(INPUT_POST, 'emailaddress', FILTER_SANITIZE_EMAIL);
        $valUserEmail = filter_var($sanUserEmail, FILTER_VALIDATE_EMAIL);
        $user_password = filter_input(INPUT_POST, 'newpassword', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_STRING);
        if($user_password != $confirm_password) {
            $_SESSION['errorMessage'] = "<p id='error-message'>Passwords do not match. Please try again.</p>";
            header('Location: ../index.php#registration');
        }
    }
    //     $passwordHash = password_hash($user_password, PASSWORD_DEFAULT);
    //     $_SESSION['firstname'] = $firstname;

    //     $emailCheck = checkExistingEmail($valUserEmail);
    //     if($emailCheck == 0) {
    //         $_SESSION['errorMessage'] = "<p id='error-message'>Email address already exists in our system. Try a different one, or, log in above.</p>";
    //     }

    //     $result = registerUser($valUserEmail, $passwordHash, $firstname, $lastname);
    //     if($result == 1) {
    //         $_SESSION['loggedIn'] = TRUE;
    //         $result = getUserIdByEmail($valUserEmail);
    //         $_SESSION['user_id'] = $result['id'];
    //         $_SESSION['successMessage'] = "<p id='success-message'>Account created successfully. Welcome!</p>";
    //         header('Location: ../dashboard.php');
    //     }
    //     else {
    //         $_SESSION['errorMessage'] = "<p id='error-message'>Error. Registration failed. Please try again.</p>";
    //         header('Location: ../index.php#registration');
    //     }
    // } else {
    //     $_SESSION['errorMessage'] ="<p id='error-message'>Error. You are already logged in with another account.</p>";
    //     header('Location: ../index.php#registration');
    // }
?>