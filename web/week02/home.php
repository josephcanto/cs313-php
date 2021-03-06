<?php session_start(); ?>
<!doctype html>
<html lang='en-US'>
<head>
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>
	<main>
        <p>
            <?php
                if(isset($_SESSION['user'])) {
                    echo 'Welcome ' . $_SESSION['user'] . '!';
                } else {
                    header('Location: login.php');
                    exit();
                }
            ?>
        </p>
        <?php
            if(isset($_SESSION['user'])) {
                echo "<a href='logout.php' title='Click here to log out' class='btn btn-primary' role='button'>Logout</a>";
            }
        ?>
    </main>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript"  src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>