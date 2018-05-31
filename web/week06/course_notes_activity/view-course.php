<?php
    require 'dbConnect.php';

    $db = get_db();

    if(!isset($db)) {
        die("DB Connection was not set");
    }

    $id = $_GET['id'];

    $query = "SELECT name, number FROM course WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $courseInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT content, date FROM note WHERE course_id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h1><?php echo "Showing notes for: " . $courseInfo["number"] . " - " . $courseInfo["name"]; ?></h1>
    <?php
        if(isset($notes)) {
            foreach($notes as $note) {
                $content = $note["content"];
                $date = $note["date"];
    
                echo "<p>$date</p><p>$note</p><br>";
            }
        }
    ?>
</body>
</html>