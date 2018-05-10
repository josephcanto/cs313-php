<?php
    session_start();
    if(isset($_SESSION["count"])) {
        $_SESSION["count"] += 1;
    } else {
        $_SESSION["count"] = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Visits Counter</title>
</head>
<body>
    <?php
        while($_SESSION["count"] < 27) {
                echo '<h1>You\'ve visited this page ' . $_SESSION["count"];
            if($_SESSION["count"] == 1) {
                echo ' time</h1>';
            } else {
                echo ' times</h1>';
            }
        }
        echo '<p><small>Don\'t you have anything better to do...?</small></p>';
    ?>
</body>
</html>