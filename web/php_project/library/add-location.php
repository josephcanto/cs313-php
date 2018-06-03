<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $website = filter_input(INPUT_POST, 'website', FILTER_VALIDATE_URL);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    if($price == "") {
        $price = "0";
    }
    $giftId = $_POST['giftid'];
    $_SESSION['giftId'] = $giftId;

    $rowsChanged = addLocation($name, $address, $website, $price, $giftId);
    if($rowsChanged != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>New location successfully added.</p>";
        $locationsInfo = getLocationsByGiftId($giftId);
        $_SESSION['locationsInfo'] = $locationsInfo;
        $locationsList = buildLocationsList($locationsInfo);
        $_SESSION['locationsList'] = $locationsList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to add new location. Please try again.</p>";
    }
    header('Location: ../view-location.php');
?>