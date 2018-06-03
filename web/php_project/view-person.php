<?php
    session_start();
    if(!isset($_SESSION['loggedIn'])) {
        header('Location: index.php');
    }
    if(isset($_SESSION['errorMessage'])) {
        unset($_SESSION['errorMessage']);
    }
    if(isset($_SESSION['successMessage'])) {
        unset($_SESSION['successMessage']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Person | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='person-page'>
        <?php
            echo "<a class='breadcrumb-trail' href='dashboard.php' title='Go back to the Dashboard page'>Dashboard</a> &gt;"
             . "<span class='breadcrumb-trail'>" . $_SESSION['personName'] . "</span>";
        ?>
        <h2 id='person-name'>
            <?php
                if(isset($_SESSION['personName'])) {
                    echo $_SESSION['personName'];
                }
                if(isset($_SESSION['personId'])) {
                    $personId = $_SESSION['personId'];
                }
            ?>
        </h2>
        <p class='user-form-instructions'>Use the form below to add a new event for <?php echo $_SESSION['personName']; ?>.</p>
        <form class='user-form' action='library/add-event.php' method='post'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required><br>
            <label for='date'>Date: </label>
            <input type='date' id='date' name='date' required><br>
            <label for='frequency'>Frequency:</label>
            <select id='frequency' name='frequency' required>
                <option value="yearly" selected="selected">Yearly</option>
                <option value="monthly">Monthly</option>
                <option value="daily">Daily</option>
            </select><br>
            <label for='reminder'>Reminder (choose a date (optional)):</label>
            <input type='date' id='reminder' name='reminder'><br>
            <input type='submit' value='Add Event'>
            <input type='hidden' name='personid' value='<?php echo $personId; ?>'>
        </form>
        <?php
            if(isset($_SESSION['eventsInfoList'])) {
                echo $_SESSION['eventsInfoList'];
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>