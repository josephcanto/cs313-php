<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php
    echo "<p>This is a PHP page.</p>";
    echo "<a href='/week02/home.php' title='see week 2 group assignment'>Week 2 Group Assignment</a>";
    $username = filter_input(INPUT_GET, 'username');
    if(isset($username)) {
      echo "<p>Welcome $username!</p>";
    } else {
      echo "<p>You are not logged in</p>";
    }
    for($i = 1; $i <= 10; $i++) {
      if($i % 2 == 0) {
        echo "<div id='Div$i' style='color: red'>Div$i</div><br>";
      } else {
        echo "<div id='Div$i'>Div$i</div><br>";
      }
    }
  ?>
</body>
</html>