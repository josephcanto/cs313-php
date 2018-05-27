<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $personId = htmlspecialchars($_GET['id']);
    $personName = getNameByPersonId($personId);
    $_SESSION['personName'] = $personName['name'];
    $personInfo = getEventsInfoByPersonId($personId);
    if(!empty($personInfo)) {
        $_SESSION['personInfo'] = $personInfo;
        $eventsInfoList = buildEventsInfoList($personInfo);
    }
    if(!empty($eventsInfoList)) {
        $_SESSION['eventsInfoList'] = $eventsInfoList;
        header('Location: ../view-person.php');
    } else {
        $_SESSION['errorMessage'] = "<p class='notice'>Oops, something went wrong on our end.</p>";
        header('Location: ../dashboard.php');
    }
?>