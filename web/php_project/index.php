<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome! | For-gift &amp; Forget</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php require 'modules/header.php'; ?>
    <main>
        <section id='banner'>
            <a id='action-button' href='#registration' title='Click here to proceed to the registration form'>Create Account</a>
        </section><!-- end of section 'banner' -->
        <section id='comic'>
            <h1>For-gift &amp; Forget</h1>
            <div id='comic-images'>
                <img class='comic-strip' src='images/comic_1.png' alt='A digital drawing of a person thinking with a thought bubble with a lightbulb inside of it'>
                <img class='comic-strip' src='images/comic_2.png' alt='A digital drawing of a smartphone with the for-gift &amp; forget app open on the screen'>
                <img class='comic-strip' src='images/comic_3.png' alt='A digital drawing of a person giving another person a gift on his birthday'>
            </div>
        </section><!-- end of section 'comic' -->
        <section id='testimonials-container'>
            <h2>Testimonials</h2>
            <div id='testimonials'>
                <div class='testimonial'>
                    <h4>John M.</h4>
                    <img class='person-image' src='images/person_icon.jpg' alt='A picture of a man smiling'>
                    <p>I love the For-gift &amp; Forget app! I haven't missed a wedding anniversary since I started using it!</p>
                </div>
                <div class='testimonial'>
                    <h4>Joe C.</h4>
                    <img class='person-image' src='images/person_icon.jpg' alt='A picture of a man smiling'>
                    <p>Thanks to the For-gift &amp; Forget app, now, people are amazed when I give them gifts!</p>
                </div>
                <div class='testimonial'>
                    <h4>Alissa C.</h4>
                    <img class='person-image' src='images/person_icon.jpg' alt='A picture of a woman smiling'>
                    <p>My friends and family have been really impressed with my gifts ever since I started using For-gift &amp; Forget!</p>
                </div>
            </div>
        </section><!-- end of section 'testimonials' -->
        <section id='registration'>
            <h5>Register today, and start impressing everyone with your awesome gift ideas! Never forget another special occasion again!</h5>
            <?php if(isset($_SESSION['error'])) echo "<p id='error-message' style='color: red;'>" . $_SESSION['error'] . "</p>"; ?>
            <form id='registration-form' action='library/register.php' method='post'>
                <input type='text' name='firstname' placeholder='First name'>
                <input type='text' name='lastname' placeholder='Last name'>
                <input type='email' name='emailaddress' placeholder='Email'>
                <input type='password' name='newpassword' placeholder='Password'>
                <input type='submit' id='create-account-btn' value='Create Account'>
            </form>
        </section><!-- end of section 'registration' -->
    </main>
    <?php require 'modules/footer.php'; ?>
</body>
</html>