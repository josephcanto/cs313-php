<?php
    function dbConnect() {
        $dbUrl = getenv('DATABASE_URL');

        $dbopts = parse_url($dbUrl);

        $dbHost = $dbopts["host"];
        $dbPort = $dbopts["port"];
        $dbUser = $dbopts["user"];
        $dbPassword = $dbopts["pass"];
        $dbName = ltrim($dbopts["path"],'/');

        try {
            $dbConn = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
            return $dbConn;
        } catch (PDOException $ex) {
            header('location: add_scriptures.php');
        }
    }
?>