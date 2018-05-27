<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Person | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main>
        <h1>
            <?php
                if(isset($_SESSION['personInfo']['name'])) {
                    echo $_SESSION['personInfo']['name'];
                }
            ?>
        </h1>
        <?php
            if(isset($_SESSION['personInfoList'])) {
                echo $_SESSION['personInfoList'];
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>