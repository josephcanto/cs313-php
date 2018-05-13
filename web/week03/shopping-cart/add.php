<?php
    session_start();

    if(isset($_POST['itemId'])) {
        $id = $_POST['itemId'];
        $_SESSION['itemQtys'][$id]++;
    }
?>