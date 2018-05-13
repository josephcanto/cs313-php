<?php
    session_start();

    $_SESSION['itemQtys'] = [
        '001' => 0,
        '002' => 0,
        '003' => 0,
        '004' => 0,
        '005' => 0,
        '006' => 0,
        '007' => 0,
        '008' => 0,
        '009' => 0,
        '010' => 0,
        '011' => 0,
        '012' => 0
    ];
    
    function increaseItemQty($itemId) {
        $_SESSION['itemQtys'][$itemId]++;
    }

    echo '<script language="javascript">';
    echo 'alert(' . $_SESSION['itemQtys'][$itemId] . ')';
    echo '</script>';
?>