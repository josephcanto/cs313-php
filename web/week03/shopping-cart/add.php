<?php
    session_start();

    if(isset($_POST['itemId'])) {
        $_SESSION['itemQtys'][$_POST['itemId']]++;
    }
?>