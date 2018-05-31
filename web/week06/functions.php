<?php
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
        return $rowsChanged;
    }

    function insertScriptureTopic($topics) {
        $db = dbConnect();
        $scripture_id = $pdo->lastInsertId('scripture_id_seq');
        $stmt = $db->prepare("INSERT INTO scripture_topics (scripture_id, topic_id)
        VALUES (:scripture_id, :topic_id)");
        $stmt->bindValue(':scripture_id', $scripture_id, PDO::PARAM_INT);
        $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function insertTopic($topics) {
        foreach($topics as $topic) {
            $db = dbConnect();
            $stmt = $db->prepare("INSERT INTO topics (name)
            VALUES (:topic)");
            $stmt->bindValue(':topic', $topic['name'], PDO::PARAM_STR);
            $stmt->execute();
            $rowsChanged = $stmt->rowCount();
            $stmt->closeCursor();
            return $rowsChanged;
        }
    }

    // function getScripturesAndTopics() {

    // }
?>