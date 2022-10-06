<?php
/*
    handles registrating a new user to the website
*/

// if registration butto nwas pressed
if (isset($_POST['registration_button'])) {


    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    // save the post variables from the form
    $username = $_POST['user_name'];
    $pwd = $_POST['user_pass'];
    $pwd_val = $_POST['user_pass_val'];

    // if input fields are empty
    if (emptyInputRegistration($username, $pwd, $pwd_val) !== false) {
        header('location: ../php/registration.php?error=emptyInput');
        exit();
    }
    // if passwords dont match
    if (differentPwd($pwd, $pwd_val) !== false) {
        header('location: ../php/registration.php?error=differentPwd');
        exit();
    }

    // if user allready exist
    if (userExist($conn, $username) !== false) {
        header('location: ../php/registration.php?error=userExist');
        exit();
    }

    // create user
    createUser($conn, $username, $pwd, $pwd_val);

} else {
    // if button not pressed, send them back to the registration site
    header('location: ../php/registration.php');
    exit();
}


?>