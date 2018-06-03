<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $isFamily = filter_input(INPUT_POST, 'family');
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    // here for testing purposes
    var_dump($name);
    var_dump($isFamily);
    var_dump($address);
?>