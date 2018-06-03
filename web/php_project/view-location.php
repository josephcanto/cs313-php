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
    <title>View Location | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main id='location-page'>
        <?php 
            echo "<a class='breadcrumb-trail' href='dashboard.php' title='Go back to the Dashboard page'>Dashboard</a> &gt;"
            . "<a class='breadcrumb-trail' href='view-person.php' title='Go back to the Person page'>" . $_SESSION['personName'] . "</a> &gt;"
            . "<a class='breadcrumb-trail' href='view-event.php' title='Go back to the Event page'>" . $_SESSION['eventName'] . "</a> &gt;"
            . "<span class='breadcrumb-trail'>" . $_SESSION['giftName'] . "</span>";
        ?>
        <h2 id='location-name'>
            <?php
                if(isset($_SESSION['giftName'])) {
                    echo $_SESSION['giftName'] . " for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'];
                }
                if(isset($_SESSION['giftId'])) {
                    $giftId = $_SESSION['giftId'];
                }
            ?>
        </h2>
        <?php 
            if(isset($_SESSION['successMessage'])) {
                if(isset($_SESSION['errorMessage'])) {
                    unset($_SESSION['errorMessage']);
                }
                echo $_SESSION['successMessage'];
            } elseif(isset($_SESSION['errorMessage'])) {
                if(isset($_SESSION['successMessage'])) {
                    unset($_SESSION['successMessage']);
                }
                echo $_SESSION['errorMessage'];
            }
        ?>
        <p class='user-form-instructions'>Use the form below to add a new location to buy <?php echo $_SESSION['giftName']; ?> for <?php echo $_SESSION['personName']; ?>'s <?php echo $_SESSION['eventName']; ?>.</p>
        <form class='user-form' action='library/add-location.php' method='post'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required><br>
            <label for='address'>Address:</label>
            <input type='text' id='address' name='address'><br>
            <label for='website'>Website URL:</label>
            <input type='text' id='website' name='website'><br>
            <label for='price'>Price: $</label>
            <input type='number' id='price' name='price' min='0.00' step='0.01' max='1000000.00' required><br>
            <input type='submit' value='Add Location'>
            <input type='hidden' name='giftid' value='<?php echo $giftId; ?>'>
        </form>
        <?php
            if(isset($_SESSION['locationsList'])) {
                echo $_SESSION['locationsList'];
            } else {
                echo "<p>Looks like you haven't added any locations to buy " . $_SESSION['giftName'] . " yet.</p>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>