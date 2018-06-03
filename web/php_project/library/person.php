<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $personId = htmlspecialchars($_GET['id']);
    $personName = getNameByPersonId($personId);
    $_SESSION['personName'] = $personName['name'];
    $personInfo = getEventsInfoByPersonId($personId);
    if(!empty($personInfo)) {
        $_SESSION['personId'] = $personId;
        $_SESSION['personInfo'] = $personInfo;
        $eventsInfoList = buildEventsInfoList($personInfo); 
        if(!empty($eventsInfoList)) {
            $_SESSION['eventsInfoList'] = $eventsInfoList;
        }
    }
    header('Location: ../view-person.php');
?>