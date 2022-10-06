<?php
/*
    handles the user login to the website
*/


// if login button is pressed
if (isset($_POST['login_button'])) {

    // save the post variables from the form
    $username = $_POST['user_name'];
    $pwd = $_POST['user_pass'];

    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    // if input fields are empty
    if (emptyInputLogin($username, $pwd) !== false) {
        // set error message in header
        header('location: ../php/login.php?error=emptyInput');
        // exit function
        exit();
    }
    // call loginUser function from 'functions.inc.php'
    loginUser($conn, $username, $pwd);

} else {
    // if button was not pressed go back to login.php
    header("location: ../php/login.php");
    exit();
}
