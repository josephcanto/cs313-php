<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $date = $_POST['date'];
    $frequency = $_POST['frequency'];
    if(isset($_POST['reminder'])) {
        $reminder = filter_input(INPUT_POST, 'reminder', FILTER_SANITIZE_NUMBER_INT);
    } else {
        $reminder = "";
    }
    $personId = $_POST['personid'];

    $rowsChanged = addEvent($name, $date, $frequency, $reminder, $personId);
    if($rowsChanged != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>New event successfully added.</p>";
        $events = getEventsInfoByPersonId($personId);
        $eventsList = buildEventsInfoList($events);
        $_SESSION['eventsList'] = $eventsList;
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to add new event. Please try again.</p>";
    }
    header('Location: ../view-person.php?id=' . $personId);
?>