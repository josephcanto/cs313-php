<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
    $eventId = $_POST['eventid'];
    $_SESSION['eventId'] = $eventId;

    $rowsChanged = addGiftIdea($name, $notes, $eventId);
    if($rowsChanged != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>New gift idea successfully added.</p>";
        $ideasInfo = getGiftIdeasByEventId($eventId);
        $ideasList = buildGiftIdeasList($ideasInfo);
        $_SESSION['giftIdeasList'] = $ideasList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to add new gift idea. Please try again.</p>";
    }
    header('Location: ../view-event.php');
?>