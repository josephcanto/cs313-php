<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $personId = htmlspecialchars($_GET['id']);
    $personName = getNameByPersonId($personId);
    $_SESSION['personName'] = $personName['name'];
    $eventsInfo = getEventsInfoByPersonId($personId);
    $_SESSION['personId'] = $personId;
    $_SESSION['eventsInfo'] = $eventsInfo;
    $eventsInfoList = buildEventsInfoList($eventsInfo); 
    $_SESSION['eventsInfoList'] = $eventsInfoList;
    header('Location: ../view-person.php');
    exit;
?>