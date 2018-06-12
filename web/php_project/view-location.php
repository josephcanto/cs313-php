<?php
    session_start();
    if(!isset($_SESSION['loggedIn'])) {
        header('Location: index.php');
        exit;
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
                unset($_SESSION['successMessage']);
            } elseif(isset($_SESSION['errorMessage'])) {
                if(isset($_SESSION['successMessage'])) {
                    unset($_SESSION['successMessage']);
                }
                echo $_SESSION['errorMessage'];
                unset($_SESSION['errorMessage']);
            }

            if(isset($_GET['action']) && $_GET['action'] == 'edit') {
                foreach($_SESSION['locationsInfo'] as $location) {
                    if($_GET['locationid'] == $location['id']) {
                        $locationId = $location['id'];
                        $name = $location['name'];
                        $address = $location['address'];
                        $website = $location['website'];
                        $price = $location['price'];
                        $gift_id = $location['gift_id'];
                    }
                }

                echo 
                "<div class='dropdown-module' id='location-dropdown-module' title='Click to expand' onclick='toggleDropdown()'>
                    <span id='dropdown-label'>Edit Location</span>
                    <span id='down-arrow'></span>
                </div>
                <div class='form-dropdown' id='location-form'>
                    <p class='user-form-instructions'>
                        Use the form below to edit the location to buy " . $_SESSION['giftName'] . " for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'] . ".
                        <br><small><em>Required fields are marked with a *</em></small>
                    </p>
                    <form class='user-form' action='library/edit-location.php' method='post'>
                        <div id='form-container'>
                            <div id='form-labels'>
                                <label for='name'>Name:*</label>
                                <label for='address'>Address:</label>
                                <label for='website'>Website URL:</label>
                                <label for='price'>Price: $</label>
                            </div>
                            <div id='form-inputs'>
                                <input class='input-styles' type='text' id='name' name='name' required value='$name'><br>
                                <input class='input-styles' type='text' id='address' name='address' value='$address'><br>
                                <input class='input-styles' type='url' id='website' name='website' value='$website'><br>
                                <input class='input-styles' type='number' id='price' name='price' value='$price'>
                            </div>
                        </div>
                        <input type='submit' value='Edit Location'>
                        <a href='view-location.php'><button type='button'>Cancel</button></a>
                        <input type='hidden' name='locationid' value='$locationId'>
                        <input type='hidden' name='giftid' value='$gift_id'>
                    </form>
                </div>";
            } else {
                echo 
                "<div class='dropdown-module' id='location-dropdown-module' title='Click to expand' onclick='toggleDropdown()'>
                    <span id='dropdown-label'>Add Location</span>
                    <span id='down-arrow'></span>
                </div>
                <div class='form-dropdown' id='location-form'>
                    <p class='user-form-instructions'>
                        Use the form below to add a new location to buy " . $_SESSION['giftName'] . " for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'] . ".
                        <br><small><em>Required fields are marked with a *</em></small>
                    </p>
                    <form class='user-form' action='library/add-location.php' method='post'>
                        <div id='form-container'>
                            <div id='form-labels'>
                                <label for='name'>Name:*</label>
                                <label for='address'>Address:</label>
                                <label for='website'>Website URL:</label>
                                <label for='price'>Price: $</label>
                            </div>
                            <div id='form-inputs'>
                                <input class='input-styles' type='text' id='name' name='name' required><br>
                                <input class='input-styles' type='text' id='address' name='address'><br>
                                <input class='input-styles' type='url' id='website' name='website'><br>
                                <input class='input-styles' type='number' id='price' name='price'>
                            </div>
                        </div>
                        <input type='submit' value='Add Location'>
                        <a href='view-location.php'><button type='button'>Cancel</button></a>
                        <input type='hidden' name='giftid' value='$giftId'>
                    </form>
                </div>";
            }

            if($_SESSION['locationsList'] != NULL) {
                echo $_SESSION['locationsList'] . "<br><br>";
            } else {
                echo "<p>Looks like you haven't added any locations to buy " . $_SESSION['giftName'] . " yet.</p><br><br><br><br><br><br><br><br>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
    <script src='js/dropdown.js'></script>
</body>
</html>