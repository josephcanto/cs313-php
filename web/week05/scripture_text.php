<html>
<body>
  <?php 
$dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
$scripture = $_GET['scripture_id'];

  
$stmt = $db->prepare("SELECT * FROM scriptures where scripture_id=$scripture");
$stmt->execute();
$info = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
echo '<p><strong>' . $info[0]['book'] . ' ' . $info[0]['chapter'] . ':' . $info[0]['verse'] . '</strong> - ' . $info[0]['content'] . '</p>';
  
echo '<img src="https://media.ldscdn.org/images/media-library/by-topic/christ-and-the-atonement/meme-hallstrom-rock-1390551-gallery.jpg"/>';
?>
  

  </body>
</html>
