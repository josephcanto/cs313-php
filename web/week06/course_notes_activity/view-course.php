<?php
    require 'dbConnect.php';

    $db = get_db();

    if(!isset($db)) {
        die("DB Connection was not set");
    }

    $id = htmlspecialchars($_GET['id']);

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
    <title><?php echo $courseInfo["name"]; ?> Course Notes</title>
</head>
<body>
    <h1><?php echo "Showing notes for: " . $courseInfo["number"] . " - " . $courseInfo["name"]; ?></h1>
    <form action="insertNote.php" method="POST">
        <input type="hidden" name="course_id" value="<?php echo $id; ?>">
        <input type="date" name="date"><br>
        <textarea name="content" placeholder="Content"></textarea>
        <br><br>
        <input type="submit" value="Add Note">
    </form>
    <?php
        if(isset($notes)) {
            foreach($notes as $note) {
                $content = $note["content"];
                $date = $note["date"];
    
                echo "<p>$date</p><p>$note</p><br>";
            }
        } else {
            echo "<p>No notes found for " . $courseInfo['number'] . "</p>";
        }
    ?>
</body>
</html>