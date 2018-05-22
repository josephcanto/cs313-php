<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Scriptures</title>
</head>

<body>
  <h1>Scripture Resources</h1>
  <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
    <input type="text" name="search-text">
    <input type="submit">
  </form>
<?php  
$dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
  
$stmt = $db->prepare('SELECT * FROM scriptures');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
if(isset($_POST["search-text"])) {
  foreach ($rows as $row){
      if ($_POST['search-text'] == $row['book']) {
        echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong><a href="scripture_text.php?scripture_id=' . $row['scripture_id'] . '">View Scripture</a>';
      }
  }
}
else {
  foreach ($rows as $row) {
    echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong><a href="scripture_text.php?scripture_id=' . $row['scripture_id'] . '"> View Scripture</a>';
  }
}
?>
</body>
</html>