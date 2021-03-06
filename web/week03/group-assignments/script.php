<?php
// define variables and set to empty values
$name = $email = $major = $comments = $continentCodes = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $major = $_POST["major"];
  $comments = test_input($_POST["comments"]);
  $continentCodes = $_POST["continents"];
}

$continents = [
    'na' => 'North America',
    'sa' => 'South America',
    'eu' => 'Europe',
    'as' => 'Asia',
    'au' => 'Australia',
    'af' => 'Africa',
    'an' => 'Antarctica'
];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display PHP Form Input</title>
</head>
<body>
    <?php
        echo "<h1>$name</h1>";
        echo "<a href='mailto:$email'>$email</a>";
        echo "<p>$major</p>";
        echo "<p>$comments</p><ul>";
        foreach($continents as $key => $value) {
            if(in_array($key, $continentCodes)) {
                echo "<li>$value</li>";
            }
        }
        echo "</ul>";
    ?>
</body>
</html>