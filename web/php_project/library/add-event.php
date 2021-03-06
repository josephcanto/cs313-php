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
    $personId = $_POST['personid'];
    $_SESSION['personId'] = $personId;

    $rowsChanged = addEvent($name, $date, $frequency, $reminder, $personId);
    if($rowsChanged != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>New event successfully added.</p>";
        $events = getEventsInfoByPersonId($personId);
        $_SESSION['eventsInfo'] = $events;
        $eventsList = buildEventsInfoList($events);
        $_SESSION['eventsInfoList'] = $eventsList;

        $people = getPeopleList($_SESSION['user_id']);
        $peopleList = buildPeopleList($people);
        $remindersList = buildRemindersList($people);
        if(!empty($remindersList)) {
            $_SESSION['remindersList'] = $remindersList;
        }
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to add new event. Please try again.</p>";
    }
    header('Location: ../view-person.php');
    exit;
?>