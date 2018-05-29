<?php
    session_start();

    $dbUrl = getenv('DATABASE_URL');

    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    function insertScripture($book, $chapter, $verse, $content) {
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

    function insertTopic($topics) {
        foreach($topics as $topic) {
            $stmt = $db->prepare("INSERT INTO topics (name)
            VALUES (:topic)");
            $stmt->bindValue(':topic', $topic['name'], PDO::PARAM_STR);
            $stmt->execute();
            $rowsChanged = $stmt->rowCount();
            $stmt->closeCursor();
            if($rowsChanged == 0) return 0;
        }
    }

    function insertScriptureTopic() {
        $scripture_id = $pdo->lastInsertId('scripture_id_seq');
        $topic_id = $pdo->lastInsertId('topic_id_seq');
        $stmt = $db->prepare("INSERT INTO scripture_topics (scripture_id, topic_id)
        VALUES (:scripture_id, :topic_id");
        $stmt->bindValue(':scripture_id', $scripture_id, PDO::PARAM_INT);
        $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
    }

    // Get user inputs
    $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
    $chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_INT);
    $verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $topics = $_POST['topics'];
    var_dump($book);
    var_dump($chapter);
    var_dump($verse);
    var_dump($content);
    var_dump($topics);

    // $result = insertScripture();
    // if($result != 0) {
    //     header('Location: scripture_text.php');
    // } else {
    //     $_SESSION['error'] = "SCripture insert failed. Please try again.";
    // }

    // $rowsChanged = insertTopic();
    // if($rowsChanged != 0) {
    //     header('Location: scripture_text.php');
    // } else {
    //     $_SESSION['error'] = "Topic insert failed. Please try again.";
    // }

    // $rowsAffected = insertScriptureTopic();
    // if($rowsAffected != 0) {
    //     header('Location: scripture_text.php');
    // } else {
    //     $_SESSION['error'] = "Insert failed. Please try again.";
    // }
?>