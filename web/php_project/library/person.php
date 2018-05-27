<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $personId = htmlspecialchars($_GET['id']);
    $personInfo = getPersonInfoById($personId);
    if(!empty($personInfo)) {
        $_SESSION['personInfo'] = $personInfo;
        header('Location: ../view-person.php');
    } else {
        $_SESSION['errorMessage'] = "<p class='notice'>Oops, something went wrong on our end.</p>";
        header('Location: ../dashboard.php');
    }
?>