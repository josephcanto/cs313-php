<?php
    require 'dbConnect.php';

    $db = get_db();

    if(!isset($db)) {
        die("DB Connection was not set");
    }

    $query = "SELECT id, name, number FROM course";
    $stmt = $db->prepare($query);
    // Bind any variables I need, here...
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses</title>
</head>
<body>
    <?php var_dump($courses); ?>
    <ul>
        <li>Course 1</li>
        <li>Course 2</li>
        <li>Course 3</li>
        <li>Course 4</li>
    </ul>
</body>
</html>