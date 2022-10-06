<?php
/*
    handles the user logout in the website
*/

// when user logs out, destroy all sessions
session_start();
session_unset();
session_destroy();
//  return user to login.php
header('location: ../php/login.php');

