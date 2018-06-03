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
    $personId = $_POST['personid'];

    $rowsUpdated = updatePerson($name, $isFamily, $address, $personId);
    if($rowsUpdated != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>Person successfully updated.</p>";
        $people = getPeopleList($_SESSION['user_id']);
        $_SESSION['peopleInfo'] = $people;
        $peopleList = buildPeopleList($people);
        $_SESSION['peopleList'] = $peopleList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to update person. Please try again.</p>";
    }
    header('Location: ../dashboard.php');
?>