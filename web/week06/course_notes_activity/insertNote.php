<?php
    $courseId = htmlspecialchars($_POST["course_id"]);
    $date = htmlspecialchars($_POST["date"]);
    $content = htmlspecialchars($_POST["content"]);

    echo "Course: $courseId\n";
    echo "date: $date\n";
    echo "content: $content";
?>