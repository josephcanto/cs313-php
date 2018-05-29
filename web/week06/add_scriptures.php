<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Scriptures</title>
</head>
<body>
    <?php
        if(isset($_SESSION['error'])) echo $_SESSION['error'];
    ?>
    <form action='insert_scriptures.php' method='post'>
        <label for='book'>Book</label>
        <input type='text' id='book' name='book'><br>
        <label for='chapter'>Chapter</label>
        <input type='number' id='chapter' name='chapter'><br>
        <label for='verse'>Verse</label>
        <input type='number' id='verse' name='verse'><br>
        <label for='content'>Content</label>
        <textarea id='content' name='content'></textarea><br>
        <?php
            $dbUrl = getenv('DATABASE_URL');

            $dbopts = parse_url($dbUrl);
        
            $dbHost = $dbopts["host"];
            $dbPort = $dbopts["port"];
            $dbUser = $dbopts["user"];
            $dbPassword = $dbopts["pass"];
            $dbName = ltrim($dbopts["path"],'/');
        
            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

            $stmt = $db->prepare("SELECT name FROM topics");
            $stmt->execute();
            $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($topics as $topic) {
                echo "<input type='checkbox' name='topics[]' value='" . $topic['name'] . "'>" . $topic['name'] . "<br>";
            }
        ?><br>
        <input type='submit' value='Insert'>
    </form>
</body>
</html>