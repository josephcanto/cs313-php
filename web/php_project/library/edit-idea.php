<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
    $giftId = $_POST['giftid'];
    $eventId = $_POST['eventid'];

    $rowsUpdated = updateGiftIdea($name, $notes, $giftId);
    if($rowsUpdated != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>Gift idea successfully updated.</p>";
        $giftInfo = getGiftIdeasByEventId($eventId);
        $_SESSION['giftInfo'] = $giftInfo;
        $giftIdeasList = buildGiftIdeasList($giftIdeasInfo);
        $_SESSION['giftIdeasList'] = $giftIdeasList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to update gift idea. Please try again.</p>";
    }
    header('Location: ../view-event.php');
?>