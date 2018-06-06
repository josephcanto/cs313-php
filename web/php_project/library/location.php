<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $giftId = htmlspecialchars($_GET['giftid']);
    $_SESSION['giftId'] = $giftId;
    $giftName = getNameByGiftId($giftId);
    $_SESSION['giftName'] = $giftName['name'];
    $locationsInfo = getLocationsByGiftId($giftId);
    $_SESSION['locationsInfo'] = $locationsInfo;
    $locationsList = buildLocationsList($locationsInfo);
    $_SESSION['locationsList'] = $locationsList;
    header('Location: ../view-location.php');
    exit;
?>