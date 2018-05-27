<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $personId = htmlspecialchars($_GET['id']);
    $personInfo = getEventsInfoByPersonId($personId);
    if(!empty($personInfo)) {
        $_SESSION['personInfo'] = $personInfo;
        var_dump($personInfo);
        $eventsInfoList = buildEventsInfoList($personInfo);
        var_dump($eventsInfoList);
    }
    // if(!empty($eventsInfoList)) {
    //     $_SESSION['eventsInfoList'] = $eventsInfoList;
    //     header('Location: ../view-person.php');
    // } else {
    //     $_SESSION['errorMessage'] = "<p class='notice'>Oops, something went wrong on our end.</p>";
    //     header('Location: ../dashboard.php');
    // }
?>