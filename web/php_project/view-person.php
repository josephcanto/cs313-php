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
    <title>View Person | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='person-page'>
        <?php
            echo "<a class='breadcrumb-trail' href='dashboard.php' title='Go back to the Dashboard page'>Dashboard</a> &gt;"
             . $_SESSION['personName'];
        ?>
        <h2 id='person-name'>
            <?php
                if(isset($_SESSION['personName'])) {
                    echo $_SESSION['personName'];
                }
            ?>
        </h2>
        <?php
            if(isset($_SESSION['eventsInfoList'])) {
                echo $_SESSION['eventsInfoList'];
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>