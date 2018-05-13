<?php
    session_start();

    if(isset($_POST['add'])) {
        $id = $_POST['add'];
        addOne($id);
    } else {
        $id = $_POST['subtract'];  
        subtractOne($id);      
    }
    header('Location: view-cart.php');

    function addOne($id) {
        $_SESSION['itemQtys'][$id]++;
    }

    function subtractOne($id) {
        $_SESSION['itemQtys'][$id]--;
    }
?>