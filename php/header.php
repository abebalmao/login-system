<?php
    // starts a session to gain access to current user
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>Forum</title>
        <title>
            WROG2 examination
        </title>
    </head>
    <header>
        <div class="navbar">
            <ul>
                <?php
                    /*
                        depending on if the user is logged in or not, show a different navbar
                    */
                    if (isset($_SESSION['userName'])) {
                        // if user is logged in
                        echo '<li><a href="index.php" >Home</a></li>';
                        echo '<li><a href="new.php" >New</a></li>';
                        echo '<li><a href="../includes/logout.inc.php">Logout</a></li>';
                    } else {
                        // else echo out this
                        echo '<li><a href="index.php" >Home</a></li>';
                        echo '<li><a href="Login.php" id="nav">Login</a></li>';
                        echo '<li><a href="Registration.php" id="nav">Registration</a></li>';
                    }
                ?>
            </ul>
        </div>
    </header>
    <body>