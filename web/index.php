<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <title>Home | CS313-02 | Joe</title>
</head>
<body class='home-page'>
    <?php
        include 'modules/header.php';
        include 'modules/nav.php';
    ?>
    <main>
        <?php
            $username = filter_input(INPUT_GET, 'username');
            if(isset($username)) {
                echo "<p>Welcome $username!</p>";
            }
        ?>
        <h1>Siberian Huskies Are Amazing!</h1>
        <p>Aren't Siberian Huskies the greatest? They are beautiful, curious creatures. Some people say that they are escape artists. Some people say that they aren't good with children. Some people say that they shed a lot... but, I love them! I'm not going to let anyone change that. So go ahead and try to change my mind if you want, but I promise you, you won't succeed!</p>
    </main>
    <?php include 'modules/footer.php'; ?>
</body>
</html>