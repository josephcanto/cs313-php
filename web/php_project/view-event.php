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
    <title>View Event | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='person-page'>
        <h2 id='person-name'>
            <?php
                if(isset($_SESSION['eventName'])) {
                    echo $_SESSION['personName'] . "'s " . $_SESSION['eventName'];
                }
            ?>
        </h2>
        <?php
            if(isset($_SESSION['giftIdeasList'])) {
                echo $_SESSION['giftIdeasList'];
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>