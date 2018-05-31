<?php
    require 'dbConnect.php';

    $db = get_db();

    if(!isset($db)) {
        die("DB Connection was not set");
    }

    $courseId = htmlspecialchars($_POST["course_id"]);
    $date = htmlspecialchars($_POST["date"]);
    $content = htmlspecialchars($_POST["content"]);

    // echo "Course: $courseId\n";
    // echo "date: $date\n";
    // echo "content: $content";

    $query = "INSERT INTO note (course_id, content, date) VALUES (:courseId, :content, :date)";
    $db->prepare($query);
    $stmt->bindValue(':courseId', $courseId, PDO::PARAM_INT);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
    header('Location: view-course.php?course_id=$courseId');
?>