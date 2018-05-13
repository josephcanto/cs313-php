<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <title>Checkout | Review Purchase Details</title>
</head>
<body>
    <div id='top-bar'>
        <p id='page-heading'>Checkout</p>
        <a href='view-cart.php'><img src='images/cart.png' alt='shopping cart icon' title='View cart' id='cart-icon'></a>
    </div>
    <br>
    <a href='view-cart.php' title='Return to your cart' class='nav-link'>Return To Cart</a>
    <h1>Enter your address and select "Make Payment" to complete your purchase.</h1>
    <form action='save-address.php' method='post'>
        <label for='firstname'>First name:</label>
        <input type='text' id='firstname' name='firstname'><br><br>
        <label for='lastname'>Last name:</label>
        <input type='text' id='lastname' name='lastname'><br><br>
        <label for='streetaddr'>Street address:</label>
        <input type='text' id='streetaddr' name='streetaddr'><br><br>
        <label for='city'>City:</label>
        <input type='text' id='city' name='city'><br><br>
        <label for='state'>State:</label>
        <input type='text' id='state' name='state'><br><br>
        <label for='zipcode'>Zipcode:</label>
        <input type='text' id='zipcode' name='zipcode'><br><br>
        <input type='submit' class='submit-form' value='Make Payment'>
    </form>
</body>
</html>