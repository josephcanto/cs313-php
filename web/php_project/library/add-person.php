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
        $_SESSION['successMessage'] = "<p id='success-message'>New person successfully added.</p>";
        $people = getPeopleList($_SESSION['user_id']);
        $peopleList = buildPeopleList($people);
        $_SESSION['peopleList'] = $peopleList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to add new person. Please try again.</p>";
    }
    header('Location: ../dashboard.php');
    exit;
?>