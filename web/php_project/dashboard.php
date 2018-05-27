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
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main>
        <h1>Family</h1>
            <ul>
                <li><a href="view-person.php?name=rick" title="View Rick's page">Rick</a></li>
                <li><a href="view-person.php?name=lucy" title="View Lucy's page">Lucy</a></li>
            </ul>
        <h1>Friends</h1>
            <ul>
                <li><a href="view-person.php?name=fred" title="View Fred's page">Fred</a></li>
                <li><a href="view-person.php?name=ethel" title="View Ethel's page">Ethel</a></li>
            </ul>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>