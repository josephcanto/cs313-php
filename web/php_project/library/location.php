<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $giftid = htmlspecialchars($_GET['giftid']);
    $giftName = getNameByGiftId($giftId);
    $_SESSION['giftName'] = $giftName['name'];
    $locationInfo = getLocationsByGiftId($giftId);
    var_dump($locationInfo);
    if(!empty($locationInfo)) {
        $_SESSION['locationInfo'] = $locationInfo;
        $locationsList = buildLocationsList($locationInfo);
        var_dump($locationsList);
    }
    // if(!empty($locationsList)) {
    //     $_SESSION['locationsList'] = $locationsList;
    //     header('Location: ../view-location.php');
    // } else {
    //     $_SESSION['errorMessage'] = "<p class='notice'>Oops, something went wrong on our end.</p>";
    //     header('Location: ../dashboard.php');
    // }
?>