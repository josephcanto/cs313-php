<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    $tableName = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    $itemId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $rowsChanged = deleteData($tableName, $itemId);
    if($rowsChanged != 0) {
        $_SESSION['successMessage'] = "<p id='success-message'>Successfully deleted record from table $tableName.</p>";
    } else {
        $_SESSION['errorMessage'] = "<p id='error-message'>Failed to delete record from table $tableName. Please try again.</p>";
    }
    
    switch($tableName) {
        case 'people':
            header('Location: ../dashboard.php');
            break;
        case 'events':
            header('Location: ../view-person.php');
            break;
        case 'ideas':
            header('Location: ../view-event.php');
            break;
        case 'locations':
            header('Location: ../view-location.php');
            break;
    }
?>