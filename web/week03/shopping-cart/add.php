<?php
    session_start();

    if(isset($_POST['id'])) {
        $_SESSION['itemQtys'][$itemId]++;
    }
    var_dump($_SESSION['itemQtys']);
?>