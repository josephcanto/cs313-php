<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $eventId = htmlspecialchars($_GET['eventid']);
    $_SESSION['eventId'] = $eventId;
    $eventName = getNameByEventId($eventId);
    $_SESSION['eventName'] = $eventName['name'];
    $giftInfo = getGiftIdeasByEventId($eventId);
    $_SESSION['giftInfo'] = $giftInfo;
    $giftIdeasList = buildGiftIdeasList($giftInfo);
    $_SESSION['giftIdeasList'] = $giftIdeasList;
    header('Location: ../view-event.php');
?>