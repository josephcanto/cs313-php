<?php
    session_start();

    $_SESSION['firstname'] = htmlspecialchars($_POST['firstname']);
    $_SESSION['lastname'] = htmlspecialchars($_POST['lastname']);
    $_SESSION['streetaddr'] = htmlspecialchars($_POST['streetaddr']);
    $_SESSION['city'] = htmlspecialchars($_POST['city']);
    $_SESSION['state'] = htmlspecialchars($_POST['state']);
    $_SESSION['zipcode'] = htmlspecialchars($_POST['zipcode']);

    header('Location: confirm.php');
?>