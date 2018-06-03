<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if(isset($_POST['notes'])) {
        $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
    } else {
        $notes = "No notes have been added for this gift idea.";
    }
    $eventId = $_POST['eventid'];
    $_SESSION['eventid'] = $eventid;

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