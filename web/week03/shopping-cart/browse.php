<?php
    session_start();
    if(!isset($_SESSION['itemQtys'])) {
        $_SESSION['itemQtys'] = [
            '001' => 0,
            '002' => 0,
            '003' => 0,
            '004' => 0,
            '005' => 0,
            '006' => 0,
            '007' => 0,
            '008' => 0,
            '009' => 0,
            '010' => 0,
            '011' => 0,
            '012' => 0
        ];
    }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <title>Browse | Rocket League T-Shirts</title>
</head>
<body>
    <div id='top-bar'>
        <p id='page-heading'>Browse our selection of Rocket League T-Shirts</p>
        <a href='view-cart.php'><img src='images/cart.png' alt='shopping cart icon' title='View cart' id='cart-icon'></a>
    </div>
    <div id='container'>
        <div>
            <figure>
                <img src='images/t-shirt-1.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 001, Size: M, Price: $10.50</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='001'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-2.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 002, Size: M, Price: $12.25</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='002'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-3.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 003, Size: M, Price: $11.35</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='003'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-4.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 004, Size: M, Price: $15.40</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='004'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-5.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 005, Size: M, Price: $8.92</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='005'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-6.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 006, Size: M, Price: $13.11</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='006'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-7.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 007, Size: M, Price: $9.73</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='007'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-8.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 008, Size: M, Price: $10.38</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='008'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-9.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 009, Size: M, Price: $12.22</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='009'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-10.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 010, Size: M, Price: $14.71</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='010'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-11.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 011, Size: M, Price: $15.87</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='011'>
            </form>
        </div>
        <div>
            <figure>
                <img src='images/t-shirt-12.jpg' alt='Rocket League T-Shirt'>
                <figcaption>Men's T-Shirt 012, Size: M, Price: $14.88</figcaption>
            </figure>
            <form action='add.php' method='post'>
                <input class='button' type='button' title='Add item to your cart' value='Add To Cart'>
                <input type='hidden' name='item' value='012'>
            </form>
        </div>
    </div>
    <!-- <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
        crossorigin="anonymous">
    </script> -->
    <!-- <script src="jquery/script.js"></script> -->
</body>
</html>