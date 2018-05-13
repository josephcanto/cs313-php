<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <title>Thank You! | Order Received Confirmation</title>
</head>
<body>
    <div id='top-bar'>
        <p id='page-heading'>Order Received Confirmation</p>
        <a href='view-cart.php'><img src='images/cart.png' alt='shopping cart icon' title='View cart' id='cart-icon'></a>
    </div>
    <p id='order-confirm'>Your order has been received and is being processed. You should expect to receive it within 3-5 business days. Thank you, and have a nice day!</p>
    <?php
        echo '<h2>You ordered:</h2>'
        . $_SESSION['customerOrder']
        . '<h2>Your order will be sent to this address:</h2>'
        . '<p class="order-details">' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</p>'
        . '<p class="order-details">' . $_SESSION['streetaddr']
        . '<p class="order-details">' . $_SESSION['city'] . ', ' . $_SESSION['state'] . ' ' . $_SESSION['zipcode'] . '</p>';
    ?>
</body>
</html>