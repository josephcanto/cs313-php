<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php echo "<p>This is a PHP page.</p>"?>
  <?php
    for($i = 1; $i <= 10; $i++) {
      if($i % 2 == 0) {
        echo "<div id='Div$i' style='font-color: red'>Div$i</div><br>";
      } else {
        echo "<div id='Div$i'>Div$i</div><br>";
      }
    }
  ?>
</body>
</html>