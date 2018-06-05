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
        $passwordHash = password_hash($user_password, PASSWORD_DEFAULT);
        $_SESSION['firstname'] = $firstname;

        $emailCheck = checkExistingEmail($valUserEmail);
        if($emailCheck == 0) {
            $_SESSION['error'] = 'Email address already exists in our system. Try a different one, or, log in above.';
        }

        $result = registerUser($valUserEmail, $passwordHash, $firstname, $lastname);
        if($result == 1) {
            $_SESSION['loggedIn'] = TRUE;
            $result = getUserIdByEmail($valUserEmail);
            $_SESSION['user_id'] = $result['id'];
            header('Location: ../dashboard.php');
        }
        else {
            $_SESSION['errorMessage'] = "<p id='error-message'>Error. Registration failed. Please try again.</p>";
            header('Location: ../index.php#registration');
        }
    } else {
        $_SESSION['errorMessage'] ="<p id='error-message'>Error. You are already logged in with another account.</p>";
        header('Location: ../index.php#registration');
    }
?>