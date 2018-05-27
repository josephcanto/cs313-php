<?php
    session_start();
    if(!isset($_SESSION['firstname'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='dashboard-page'>
        <?php
            if(isset($_SESSION['peopleList'])) {
                echo $_SESSION['peopleList'];
            } else {
                echo "<h1 class='people-list-heading'>Looks like you haven't added anyone yet!</h1>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>