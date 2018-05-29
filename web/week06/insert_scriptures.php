<?php
    session_start();

    function dbConnect() {
        $dbUrl = getenv('DATABASE_URL');

        $dbopts = parse_url($dbUrl);
    
        $dbHost = $dbopts["host"];
        $dbPort = $dbopts["port"];
        $dbUser = $dbopts["user"];
        $dbPassword = $dbopts["pass"];
        $dbName = ltrim($dbopts["path"],'/');
    
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);    
    }

    function insertScripture($book, $chapter, $verse, $content) {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO scriptures (book, chapter, verse, content)
        VALUES (:book, :chapter, :verse, :content)");
        $stmt->bindValue(':book', $book, PDO::PARAM_STR);
        $stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);
        $stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
    }

    function insertScriptureTopic($topics) {
        $db = dbConnect();
        $scripture_id = $pdo->lastInsertId('scripture_id_seq');
        $stmt = $db->prepare("INSERT INTO scripture_topics (scripture_id, topic_id)
        VALUES (:scripture_id, :topic_id");
        $stmt->bindValue(':scripture_id', $scripture_id, PDO::PARAM_INT);
        $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
    }

    // function insertTopic($topics) {
    //     foreach($topics as $topic) {
    //         $db = dbConnect();
    //         $stmt = $db->prepare("INSERT INTO topics (name)
    //         VALUES (:topic)");
    //         $stmt->bindValue(':topic', $topic['name'], PDO::PARAM_STR);
    //         $stmt->execute();
    //         $rowsChanged = $stmt->rowCount();
    //         $stmt->closeCursor();
    //         if($rowsChanged == 0) return 0;
    //     }
    // }

    // Get user inputs
    $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
    $chapter = (int)filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_NUMBER_INT);
    $verse = (int)filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $topics = $_POST['topics'];

    $result = insertScripture($book, $chapter, $verse, $content);
    if($result != 0) {
        header('Location: scripture_text.php');
    } else {
        $_SESSION['error'] = "SCripture insert failed. Please try again.";
    }

    // $rowsAffected = insertScriptureTopic();
    // if($rowsAffected != 0) {
    //     header('Location: scripture_text.php');
    // } else {
    //     $_SESSION['error'] = "Insert failed. Please try again.";
    // }

    // $rowsChanged = insertTopic($topics);
    // if($rowsChanged != 0) {
    //     header('Location: scripture_text.php');
    // } else {
    //     $_SESSION['error'] = "Topic insert failed. Please try again.";
    // }
?>