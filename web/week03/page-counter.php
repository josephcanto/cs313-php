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
    <title>Document</title>
</head>
<body>
    <?php echo '<h1>' . $_SESSION["count"] . '</h1>'; ?>
</body>
</html>