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
        <h1 id='dashboard-heading'>For-gift &amp; Forget Dashboard <?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo "- Edit Mode"; ?></h1>
        <?php
            if(isset($_SESSION['successMessage'])) {
                if(isset($_SESSION['errorMessage'])) {
                    unset($_SESSION['errorMessage']);
                }
                echo $_SESSION['successMessage'];
                unset($_SESSION['successMessage']);
            } elseif(isset($_SESSION['errorMessage'])) {
                echo $_SESSION['errorMessage'];
                unset($_SESSION['errorMessage']);
            }
            if(isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
            }
            
            if(isset($_GET['action']) && $_GET['action'] == 'edit') {
                foreach($_SESSION['peopleInfo'] as $person) {
                    if(isset($_GET['personid'])) {
                        if($person['id'] == $_GET['personid']) {
                            $personId = $person['id'];
                            $name = $person['name'];
                            $isFamily = $person['is_family'];
                            $address = $person['address'];
                        }
                    }
                }
                if($isFamily) {
                    $isFamily = "checked";
                } else {
                    $isFamily = "";
                }

                echo "<p class='user-form-instructions'>Use the form below to edit $name's record.</p>
                    <form class='user-form' action='library/edit-person.php' method='post'>
                        <label for='name'>Name:</label>
                        <input type='text' id='name' name='name' required value='$name'><br>
                        <label for='family'>Family member?</label>
                        <input type='checkbox' id='family' name='family' $isFamily><br>
                        <label for='address'>Address (optional):</label>
                        <input type='text' id='address' name='address' value='$address'><br>
                        <input type='submit' value='Edit Person'>
                        <input type='hidden' name='personid' value='$personId'>
                    </form>";
            } else {
                echo "<p class='user-form-instructions'>Use the form below to add a new person to your list.</p>
                <form class='user-form' action='library/add-person.php' method='post'>
                    <label for='name'>Name:</label>
                    <input type='text' id='name' name='name' required><br>
                    <label for='family'>Family member?</label>
                    <input type='checkbox' id='family' name='family'><br>
                    <label for='address'>Address (optional):</label>
                    <input type='text' id='address' name='address'><br>
                    <input type='submit' value='Add Person'>
                    <input type='hidden' name='userid' value='$userId'>
                </form>";
            }
        
            if(isset($_SESSION['peopleList'])) {
                echo $_SESSION['peopleList'] . "<br><br>";
            } else {
                echo "<h2 class='people-list-heading'>Looks like you haven't added anyone yet!</h2><br><br><br><br><br>";
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>