<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $giftId = htmlspecialchars($_GET['giftid']);
    $giftName = getNameByGiftId($giftId);
    $_SESSION['giftName'] = $giftName['name'];
    $locationInfo = getLocationsByGiftId($giftId);
    if(!empty($locationInfo)) {
        $_SESSION['locationInfo'] = $locationInfo;
        $locationsList = buildLocationsList($locationInfo);
        if(!empty($locationsList)) {
            $_SESSION['locationsList'] = $locationsList;
        }
    }
    header('Location: ../view-location.php');
?>