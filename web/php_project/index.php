<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome! | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main>
        <section id='banner'>
            <?php
                if(isset($_SESSION['loggedIn'])) {
                    echo "<a id='action-button' href='dashboard.php' title='Click here to go to your dashboard page'>Go To Dashboard</a>";
                } else {
                    echo "<a id='action-button' href='#registration' title='Click here to proceed to the registration form'>Create Account</a>";
                }
            ?>
        </section><!-- end of section 'banner' -->
        <section id='comic'>
            <h1>For-gift &amp; Forget</h1>
            <p class='intro-paragraph'>With For-gift &amp; Forget, you can keep track of your awesome gift ideas the moment you think of them, and then when that special occasion arrives, you'll be prepared to give the perfect gifts to your friends and family. Never forget a special occasion or an awesome gift idea ever again!</p>
            <div id='comic-images'>
                <img class='comic-strip' src='images/lightbulb.png' alt='A digital drawing of a lightbulb'>
                <img class='comic-strip' src='images/comic_2.png' alt='A digital drawing of a smartphone with the For-gift &amp; Forget app open on the screen'>
                <img class='comic-strip' src='images/gift_giving.png' alt='A digital drawing of a person giving a gift'>
            </div>
            <p class='intro-paragraph'>Registration is completely free. All you have to do is create an account, and you can start tracking your gift ideas and special occasions today!</p>
        </section><!-- end of section 'comic' -->
        <section id='testimonials-container'>
            <h2>Testimonials</h2>
            <div id='testimonials'>
                <div class='testimonial'>
                    <h4>John M.</h4>
                    <img class='person-image' src='images/person_icon.jpg' alt='An icon representing a person'>
                    <p>I love the For-gift &amp; Forget app! I haven't missed a wedding anniversary since I started using it!</p>
                </div>
                <div class='testimonial'>
                    <h4>Joe C.</h4>
                    <img class='person-image' src='images/person_icon.jpg' alt='An icon representing a person'>
                    <p>Thanks to the For-gift &amp; Forget app, now, people are amazed when I give them gifts!</p>
                </div>
                <div class='testimonial'>
                    <h4>Alissa C.</h4>
                    <img class='person-image' src='images/person_icon.jpg' alt='An icon representing a person'>
                    <p>My friends and family have been really impressed with my gifts ever since I started using For-gift &amp; Forget!</p>
                </div>
            </div>
        </section><!-- end of section 'testimonials' -->
        <?php 
            if(!isset($_SESSION['loggedIn'])) {
                echo "<section id='registration'>
                          <h3>Register today, and start impressing everyone with your awesome gift ideas! Never forget another special occasion again!</h3>";
                if(isset($_SESSION['errorMessage'])) {
                    echo $_SESSION['errorMessage'];
                    unset($_SESSION['errorMessage']);
                }
                if(!isset($_SESSION['first_name'])) {
                    echo "<form id='registration-form' action='library/register.php' method='post'>
                              <input type='text' name='firstname' placeholder='First name' required>
                              <input type='text' name='lastname' placeholder='Last name' required>
                              <input type='email' name='emailaddress' placeholder='Email' required>
                              <input type='password' id='password' name='newpassword' placeholder='Password' title='Passwords must contain at least 7 characters, with at least 1 of the characters being a number' pattern='(?=.*?\d).{7,}' onchange='compareInputs();' required>
                              <input type='password' id='confirmpassword' name='confirmpassword' placeholder='Confirm Password' onchange='compareInputs();' required>
                              <input type='submit' id='create-account-btn' value='Create Account' title='Click here to create your account after filling out the form fields above' disabled>
                          </form>
                      </section><!-- end of section 'registration' -->";
                } else {
                    $firstname = $_SESSION['first_name'];
                    $lastname = $_SESSION['last_name'];
                    $email = $_SESSION['user_email'];
                    unset($_SESSION['first_name']);
                    unset($_SESSION['last_name']);
                    unset($_SESSION['user_email']);
                    echo "<form id='registration-form' action='library/register.php' method='post'>
                    <input type='text' name='firstname' placeholder='First name' required value='$firstname'>
                    <input type='text' name='lastname' placeholder='Last name' required value='$lastname'>
                    <input type='email' name='emailaddress' placeholder='Email' required value='$email'>
                    <input type='password' id='password' name='newpassword' placeholder='Password' title='Passwords must contain at least 7 characters, with at least 1 of the characters being a number' pattern='(?=.*?\d).{7,}' onchange='compareInputs();' required>
                    <input type='password' id='confirmpassword' name='confirmpassword' placeholder='Confirm Password' onchange='compareInputs();' required>
                    <input type='submit' id='create-account-btn' value='Create Account' title='Click here to create your account after filling out the form fields above' disabled>
                </form>
            </section><!-- end of section 'registration' -->";
                }
            }
        ?>
    </main>
    <?php require 'modules/footer.php'; ?>
    <script>
        function compareInputs() {
            var create_account_btn = document.getElementById('create-account-btn');
            var password_input = document.getElementById('password');
            var confirm_input = document.getElementById('confirmpassword');
            
            if(
                password_input.value == confirm_input.value &&
                (/(?=.*?\d).{7,}/).test(password_input.value) &&
                (/(?=.*?\d).{7,}/).test(confirm_input.value)
            ) {
                create_account_btn.disabled = false;
                password_input.style.border = "2px solid #2ECC71";
                confirm_input.style.border = "2px solid #2ECC71";
            } else {
                create_account_btn.disabled = true;
                password_input.style.border = "2px solid #CB4335";
                confirm_input.style.border = "2px solid #CB4335";
            }
        }
    </script>
</body>
</html>