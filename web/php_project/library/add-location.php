<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $date = $_POST['date'];
    $frequency = $_POST['frequency'];
    if(isset($_POST['reminder'])) {
        $reminder = $_POST['reminder'];
    } else {
        $reminder = NULL;
    }
    $giftId = $_POST['giftid'];
    $_SESSION['giftid'] = $giftId;

    $rowsChanged = addLocation($name, $date, $frequency, $reminder, $personId);
    if($rowsChanged != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>New event successfully added.</p>";
        $locationInfo = getLocationsByGiftId($giftId);
        $locationsList = buildLocationsList($locationInfo);
        $_SESSION['locationsList'] = $locationsList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to add new location. Please try again.</p>";
    }
    header('Location: ../view-event.php');
?>