<?php
    session_start();

    $itemId = $_POST['item'];
    addOneToQty($itemId);

    function addOneToQty($id) {
        $_SESSION['itemQtys'][$id]++;
    }
?>