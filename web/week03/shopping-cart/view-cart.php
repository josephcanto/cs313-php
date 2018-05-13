<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <title>Your Shopping Cart</title>
</head>
<body>
    <div id='top-bar'>
        <p id='page-heading'>Your Shopping Cart</p>
        <a href='view-cart.php'><img src='images/cart.png' alt='shopping cart icon' title='View cart' id='cart-icon'></a>
    </div>
    <br>
    <a href='browse.php' title='Continue browsing' class='nav-link'>Continue Browsing</a>
    <span>|</span>
    <a href='checkout.php' title='Checkout' class='nav-link'>Checkout</a>
    <h1>Take a look at what's in your shopping cart:</h1>
    <?php
        $outputStr = '<ul>';
        $customerOrder = '<ul>';
        foreach($_SESSION['itemQtys'] as $item => $quantity) {
            if($quantity > 0) {
                $outputStr .=
                    '<li>Men\'s T-Shirt ' . $item . ': Qty. ' . $quantity . '<div class="qty-btns">
                    <form action="change-qty.php" method="post"><input type="submit" value="-">
                    <input type="hidden" name="subtract" value="' . $item . '"></form>
                    <form action="change-qty.php" method="post"><input type="submit" value="+">
                    <input type="hidden" name="add" value="' . $item . '"></form></div><img class="cart-image" 
                    src="images/t-shirt-' . $item . '.jpg" alt="Rocket League T-Shirt">
                    <br><a class="remove-link" href="delete.php?item=' . $item . '">Remove item from cart</a></li>';
                $customerOrder .= 
                    '<li class="purchase">Men\'s T-Shirt ' . $item . ': Qty. ' . $quantity . '<br><img class="cart-image" 
                    src="images/t-shirt-' . $item . '.jpg" alt="Rocket League T-Shirt"><br></li>';
            }
        }
        $outputStr .= '</ul>';
        $customerOrder .= '</ul>';
        if($outputStr != '<ul></ul>') {
            $_SESSION['customerOrder'] = $customerOrder;
            echo $outputStr;
        } else {
            echo '<p id="empty-cart">Whoops! Looks like your cart is empty! Come back once you\'ve added at least one item.</p>';
        }
    ?>
</body>
</html>