<?php
    require 'dbConnect.php';

    $db = get_db();

    if(!isset($db)) {
        die("DB Connection was not set");
    }

    $id = $_GET['id'];
    var_dump($id);

    // $query = "SELECT name, number FROM course INNER JOIN note ON course.id=note.course_id WHERE course.id=:id";
    // $stmt = $db->prepare($query);
    // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    // $stmt->execute();
    // $courseInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $courseInfo["name"]; ?> Course Information</title>
</head>
<body>
    <h1><?php echo $courseInfo["name"]; ?></h1>
    <?php var_dump($courseInfo); ?>
</body>
</html>