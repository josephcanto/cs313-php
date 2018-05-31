<?php session_start(); ?>
<html>
    <body>
        <?php 
            if(isset($_SESSION['scriptureList'])) {
                echo $_SESSION['scriptureList'];
            } else {
                echo $_SESSION['error'];
            }
        ?>
        <img src="https://media.ldscdn.org/images/media-library/by-topic/christ-and-the-atonement/meme-hallstrom-rock-1390551-gallery.jpg"/>';
    </body>
</html>