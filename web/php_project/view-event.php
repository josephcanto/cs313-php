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
    <title>View Event | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='event-page'>
        <?php 
            echo "<a class='breadcrumb-trail' href='dashboard.php' title='Go back to the Dashboard page'>Dashboard</a> &gt;"
            . "<a class='breadcrumb-trail' href='view-person.php' title='Go back to the View Person page'>" . $_SESSION['personName'] . "</a> &gt;"
            . "<span class='breadcrumb-trail'>" . $_SESSION['eventName'] . "</span>";
        ?>
        <h2 id='event-name'>
            <?php
                if(isset($_SESSION['eventName'])) {
                    echo $_SESSION['personName'] . "'s " . $_SESSION['eventName'];
                }
                if(isset($_SESSION['eventId'])) {
                    $eventId = $_SESSION['eventId'];
                }
            ?>
        </h2>
        <?php 
            if(isset($_SESSION['successMessage'])) {
                if(isset($_SESSION['errorMessage'])) {
                    unset($_SESSION['errorMessage']);
                }
                echo $_SESSION['successMessage'];
                unset($_SESSION['successMessage']);
            } elseif(isset($_SESSION['errorMessage'])) {
                if(isset($_SESSION['successMessage'])) {
                    unset($_SESSION['successMessage']);
                }
                echo $_SESSION['errorMessage'];
                unset($_SESSION['errorMessage']);
            }
        ?>
        <p class='user-form-instructions'>Use the form below to add a new gift idea for <?php echo $_SESSION['personName']; ?>'s <?php echo $_SESSION['eventName']; ?>.</p>
        <form class='user-form' action='library/add-idea.php' method='post'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required><br>
            <label for='notes'>Notes (optional): </label>
            <textarea id='notes' name='notes' rows='4' cols='50'></textarea><br>
            <input type='submit' value='Add Gift Idea'>
            <input type='hidden' name='eventid' value='<?php echo $eventId; ?>'>
        </form>
        <?php
            if($_SESSION['giftIdeasList'] != NULL) {
                echo $_SESSION['giftIdeasList'] . "<br><br>";
            } else {
                echo "<p>Looks like you haven't added any gift ideas for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'] . " yet.</p><br><br><br><br>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>