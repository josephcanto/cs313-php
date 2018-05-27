<?php
    session_start();
    if(!isset($_SESSION['loggedIn'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Location | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='location-page'>
        <?php 
            echo "<a class='breadcrumb-trail' href='dashboard.php' title='Go back to the Dashboard page'>Dashboard</a> &gt;"
            . "<a class='breadcrumb-trail' href='view-person.php' title='Go back to the Person page'>" . $_SESSION['personName'] . "</a> &gt;"
            . "<a class='breadcrumb-trail' href='view-event.php' title='Go back to the Event page'>" . $_SESSION['eventName'] . "</a> &gt;"
            . "<span class='breadcrumb-trail'>" . $_SESSION['giftName'] . "</span>";
        ?>
        <h2 id='location-name'>
            <?php
                if(isset($_SESSION['giftName'])) {
                    echo $_SESSION['giftName'] . " for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'];
                }
            ?>
        </h2>
        <?php
            if(isset($_SESSION['locationsList'])) {
                echo $_SESSION['locationsList'];
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>