<header>
    <img id='logo' src='images/logo.png' alt='for-gift &amp; forget website logo'>
    <nav>
        <?php
            if(isset($_SESSION['firstname'])) {
                $firstname = $_SESSION['firstname'];
                echo "<p>Welcome, $firstname! </p><a id='logout-button' href='library/logout.php' title='Click here to log out'>Log Out</a>";
            } else {
                echo "
                    <form id='login-form' action='library/login.php' method='post'>
                    <input type='email' name='email' placeholder='Email'>
                    <input type='password' name='password' placeholder='Password'>
                    <input type='submit' id='login-btn' value='Log In'>
                    </form>
                ";
            }
        ?>
    </nav>
</header>