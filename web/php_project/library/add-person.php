<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if(isset($_POST['family'])) {
        $isFamily = TRUE;
    } else {
        $isFamily = FALSE;
    }
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $userId = $_POST['userid'];

    // here for testing purposes
    var_dump($name);
    var_dump($isFamily);
    var_dump($address);
    var_dump($userId);
?>