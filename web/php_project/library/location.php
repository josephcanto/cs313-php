<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $giftId = htmlspecialchars($_GET['giftid']);
    $_SESSION['giftId'] = $giftId;
    $giftName = getNameByGiftId($giftId);
    $_SESSION['giftName'] = $giftName['name'];
    $locationInfo = getLocationsByGiftId($giftId);
    $_SESSION['locationInfo'] = $locationInfo;
    $locationsList = buildLocationsList($locationInfo);
    $_SESSION['locationsList'] = $locationsList;
    header('Location: ../view-location.php');
?>