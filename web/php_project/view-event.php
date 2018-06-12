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

            if(isset($_GET['action']) && $_GET['action'] == 'edit') {
                foreach($_SESSION['giftsInfo'] as $giftIdea) {
                    if($_GET['giftid'] == $giftIdea['id']) {
                        $giftId = $giftIdea['id'];
                        $name = $giftIdea['name'];
                        $notes = $giftIdea['notes'];
                        $event_id = $giftIdea['event_id'];
                    }
                }

                echo 
                "<div class='dropdown-module' id='gift-dropdown-module' onclick='toggleDropdown()'>
                    <span id='dropdown-label' onclick='toggleDropdown()'>Edit Gift Idea</span>
                </div>
                <div class='form-dropdown' id='gift-form'>
                    <p class='user-form-instructions'>
                        Use the form below to edit the gift idea for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'] . ".
                        <br><small><em>Required fields are marked with a *</em></small>
                    </p>
                    <form class='user-form' action='library/edit-idea.php' method='post'>
                        <div id='form-container'>
                            <div id='form-labels'>
                                <label for='name'>Name:*</label>
                                <label for='notes'>Notes:</label>
                            </div>
                            <div id='form-inputs'>
                                <input class='input-styles' type='text' id='name' name='name' required value='$name'><br>
                                <textarea id='notes' name='notes' rows='4' cols='30'>$notes</textarea>
                            </div>
                        </div>
                        <input type='submit' id='submit-btn' value='Edit Gift Idea'>
                        <input type='hidden' name='giftid' value='$giftId'>
                        <input type='hidden' name='eventid' value='$event_id'>
                    </form>
                </div>";
            } else {
                echo 
                "<div class='dropdown-module' id='gift-dropdown-module' onclick='toggleDropdown()'>
                    <span id='dropdown-label' onclick='toggleDropdown()'>Add Gift Idea</span>
                </div>
                <div class='form-dropdown' id='gift-form'>
                    <p class='user-form-instructions'>
                        Use the form below to add a new gift idea for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'] . ".
                        <br><small><em>Required fields are marked with a *</em></small>
                    </p>
                    <form class='user-form' action='library/add-idea.php' method='post'>
                        <div id='form-container'>
                            <div id='form-labels'>
                                <label for='name'>Name:*</label>
                                <label for='notes'>Notes:</label>
                            </div>
                            <div id='form-inputs'>
                                <input class='input-styles' type='text' id='name' name='name' required><br>
                                <textarea id='notes' name='notes' rows='4' cols='30'></textarea>
                            </div>
                        </div>
                        <input type='submit' value='Add Gift Idea'>
                        <input type='hidden' name='eventid' value='$eventId'>
                    </form>
                </div>";
            }

            if($_SESSION['giftIdeasList'] != NULL) {
                echo $_SESSION['giftIdeasList'] . "<br><br>";
            } else {
                echo "<p>Looks like you haven't added any gift ideas for " . $_SESSION['personName'] . "'s " . $_SESSION['eventName'] . " yet.</p><br><br><br><br><br><br><br><br>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
    <script src='js/dropdown.js'></script>
</body>
</html>