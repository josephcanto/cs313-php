<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database Connection Test</title>
</head>
<body>
    <h1>Awesome web app coming soon!</h1>
    <?php
        $dbUrl = getenv('DATABASE_URL');

        $dbopts = parse_url($dbUrl);
    
        $dbHost = $dbopts["host"];
        echo $dbHost . '<br>';
        $dbPort = $dbopts["port"];
        echo $dbPort . '<br>';
        $dbUser = $dbopts["user"];
        echo $dbUser . '<br>';
        $dbPassword = $dbopts["pass"];
        echo $dbPassword . '<br>';
        $dbName = ltrim($dbopts["path"],'/');
        echo $dbName;
    
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
        // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $db->prepare('SELECT * FROM users WHERE id=:id AND lastname=:lastname');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row) {
            echo '<p>User ID: ' . $row['id'] . '<br>Last Name: ' . $row['lastname'] . '</p><br>';
        }
    ?>
</body>
</html>