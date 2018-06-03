<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $website = filter_input(INPUT_POST, 'website', FILTER_VALIDATE_URL);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    if($price == "") {
        $price = "0.00";
    }
    $locationId = $_POST['locationid'];
    $giftId = $_POST['giftid'];

    $rowsUpdated = updateLocation($name, $address, $website, $price, $locationId);
    if($rowsUpdated != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>Location successfully updated.</p>";
        $locationsInfo = getLocationsByGiftId($giftId);
        $_SESSION['locationsInfo'] = $locationsInfo;
        $locationsList = buildLocationsList($locationsInfo);
        $_SESSION['locationsList'] = $locationsList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to update location. Please try again.</p>";
    }
    header('Location: ../view-location.php');
?>