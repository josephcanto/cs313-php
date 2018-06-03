<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if(isset($_POST['family'])) {
        $isFamily = TRUE;
    } else {
        $isFamily = FALSE;
    }
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $userId = $_POST['userid'];

    $rowsChanged = addPerson($name, $isFamily, $address, $userId);
    if($rowsChanged != 0) {
        $_SESSION['successMessage'] = "<p>New person successfully added.</p>";
    } else {
        $_SESSION['errorMessage'] = "<p>Failed to new add person. Please try again.</p>";
    }
    header('Location: ../dashboard.php');
?>