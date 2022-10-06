<?php
/*
    handles creating a new post in the forum
*/

// start session to get access to the users username
session_start();

// if new post button was pressed
if (isset($_POST['new_post'])) {

    // save input fields as variables
    $subject = $_POST['post_subject'];
    $content = $_POST['post_content'];
    // as well as the username via sessions
    $user = $_SESSION['userName'];

    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    // check if input fields are empty
    if (emptyInputPosts($subject, $content) !== false) {
        // if they are set a error message in the header
        header('location: ../php/new.php?error=emptyInput');
        // exit function
        exit();
    }
    // call createPost and pass in the variables in 'functions.inc.php'
    createPost($conn, $subject, $content, $user);

} else {
    header("location: ../php/login.php");
    exit();
}
