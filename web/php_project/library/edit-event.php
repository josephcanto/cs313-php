<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $date = $_POST['date'];
    $frequency = $_POST['frequency'];
    if(isset($_POST['reminder'])) {
        $reminder = $_POST['reminder'];
    } else {
        $reminder = NULL;
    }
    $eventId = $_POST['eventid'];
    $personId = $_POST['personid'];

    $rowsUpdated = updateEvent($name, $date, $frequency, $reminder, $eventId);
    if($rowsUpdated != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>Event successfully updated.</p>";
        $events = getEventsInfoByPersonId($personId);
        $_SESSION['eventsInfo'] = $events;
        $eventsList = buildEventsInfoList($events);
        $_SESSION['eventsInfoList'] = $eventsList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to update event. Please try again.</p>";
    }
    header('Location: ../view-person.php');
    exit;
?>