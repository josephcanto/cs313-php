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
                foreach($_SESSION['personInfo'] as $event) {
                    if($_GET['eventid'] = $event['id']) {
                        $eventId = $event['id'];
                        $name = $event['name'];
                        $date = $event['date'];
                        $frequency = $event['frequency'];
                        $reminder = $event['reminder'];
                        $person_id = $event['person_id'];
                    }
                }

                echo "<p class='user-form-instructions'>Use the form below to edit " . $_SESSION['personName'] . "'s $name event.</p>
                      <form class='user-form' action='library/edit-event.php' method='post'>
                          <label for='name'>Name:</label>
                          <input type='text' id='name' name='name' required value='$name'><br>
                          <label for='date'>Date: </label>
                          <input type='date' id='date' name='date' required value='$date'><br>
                          <label for='frequency'>Frequency:</label>
                          <select id='frequency' name='frequency' required>";
                          if($frequency == 'Yearly') {
                              echo "<option value='Yearly' selected='selected'>Yearly</option>
                                    <option value='Monthly'>Monthly</option>
                                    <option value='One-time'>One-time</option>";
                          } elseif($frequency == 'Monthly') {
                            echo "<option value='Yearly'>Yearly</option>
                                  <option value='Monthly' selected='selected'>Monthly</option>
                                  <option value='One-time'>One-time</option>";
                          } else {
                            echo "<option value='Yearly'>Yearly</option>
                                  <option value='Monthly'>Monthly</option>
                                  <option value='One-time' selected='selected'>One-time</option>";
                          }
                    echo "</select><br>
                          <label for='reminder'>Reminder (choose a date (optional)):</label>
                          <input type='date' id='reminder' name='reminder' value='$reminder'><br>
                          <input type='submit' value='Edit Event'>
                          <input type='hidden' name='eventid' value='$eventId'>
                          <input type='hidden' name='personid' value='$person_id'>
                      </form>";
            } else {
                echo "<p class='user-form-instructions'>Use the form below to add a new event for " . $_SESSION['personName'] . ".</p>
                     <form class='user-form' action='library/add-event.php' method='post'>
                            <label for='name'>Name:</label>
                            <input type='text' id='name' name='name' required><br>
                            <label for='date'>Date: </label>
                            <input type='date' id='date' name='date' required><br>
                            <label for='frequency'>Frequency:</label>
                            <select id='frequency' name='frequency' required>
                                <option value='Yearly' selected='selected'>Yearly</option>
                                <option value='Monthly'>Monthly</option>
                                <option value='One-time'>One-time</option>
                            </select><br>
                            <label for='reminder'>Reminder (choose a date (optional)):</label>
                            <input type='date' id='reminder' name='reminder'><br>
                            <input type='submit' value='Add Event'>
                            <input type='hidden' name='personid' value='$personId'>
                      </form>";
            }

            if($_SESSION['eventsInfoList'] != NULL) {
                echo $_SESSION['eventsInfoList'] . "<br><br>";
            } else {
                echo "<p>Looks like you haven't added any events for " . $_SESSION['personName'] . " yet.</p><br><br><br><br>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>