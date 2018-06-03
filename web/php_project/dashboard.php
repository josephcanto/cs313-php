<?php
    session_start();
    if(!isset($_SESSION['loggedIn'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='dashboard-page'>
        <?php
            if(isset($_SESSION['errorMessage'])) {
                echo $_SESSION['errorMessage'];
            }
            if(isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
            }
        ?>
        <p class='user-form-instructions'>Use the form below to add a new person to your list.</p>
        <form class='user-form' action='library/add-person.php' method='post'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required><br>
            <label for='family'>Family member?</label>
            <input type='checkbox' id='family' name='family'><br>
            <label for='address'>Address (optional):</label>
            <input type='text' id='address' name='address'><br>
            <input type='submit' value='Add Person'>
            <input type='hidden' name='userid' value='<?php echo $userId; ?>'>
        </form>
        <?php
            if(isset($_SESSION['peopleList'])) {
                echo $_SESSION['peopleList'];
            } else {
                echo "<h2 class='people-list-heading'>Looks like you haven't added anyone yet!</h2>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>