<?php
    session_start();
    
    $itemId = $_GET['item'];
    removeItemFromCart($itemId);

    function removeItemFromCart($id) {
        $_SESSION['itemQtys'][$id] = 0;
        header('Location: view-cart.php');
    }
?>