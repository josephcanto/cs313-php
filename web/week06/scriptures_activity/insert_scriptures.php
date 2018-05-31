<?php
    require 'connect.php';
    require 'functions.php';

    session_start();

    // Get user inputs
    $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
    $chapter = (int)filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_NUMBER_INT);
    $verse = (int)filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $topics = $_POST['topics'];

    $rowsChanged = insertScripture($book, $chapter, $verse, $content);
    if($rowsChanged == 0) {
        $_SESSION['error'] = "Scripture insert failed. Please try again.";
        header('Location: add_scriptures.php');
    }

    $rowsChanged = insertScriptureTopic($topics);
    if($rowsChanged == 0) {
        $_SESSION['error'] = "Insert failed. Please try again.";
        header('Location: add_scriptures.php');
    }

    $rowsChanged = insertTopic($topics);
    if($rowsChanged == 0) {
        $_SESSION['error'] = "Topic insert failed. Please try again.";
        header('Location: add_scriptures.php');
    }
    header('Location: scripture_text.php');
?>