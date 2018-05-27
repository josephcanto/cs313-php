<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $eventId = htmlspecialchars($_GET['eventid']);
    $eventName = getNameByEventId($eventId);
    $_SESSION['eventName'] = $eventName['name'];
    $giftInfo = getGiftIdeasByEventId($eventId);
    if(!empty($giftInfo)) {
        $_SESSION['giftInfo'] = $giftInfo;
        $giftIdeasList = buildGiftIdeasList($giftInfo);
    }
    if(!empty($giftIdeasList)) {
        $_SESSION['giftIdeasList'] = $giftIdeasList;
        header('Location: ../view-event.php');
    } else {
        $_SESSION['errorMessage'] = "<p class='notice'>Oops, something went wrong on our end.</p>";
        header('Location: ../dashboard.php');
    }
?>