<?php
    $dbUrl = getenv('DATABASE_URL');

    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $query = $db->prepare('SELECT title, year FROM movies');
    $query->execute();
    $movies = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies Practice Exercise</title>
</head>
<body>
    <h1>Movies</h1>
    <?php
        echo '<ul>';
        foreach ($movies as $movie) {
            $title = $movie['title'];
            $year = $movie['year'];
            echo "<li>$title";
            if($movie['year'] != NULL) {
                echo " ($year)";
            }
            echo "</li>";
        }
        echo '</ul>';
    ?>
</body>
</html>