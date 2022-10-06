<?php
/*
    DB handler, handles the connection to the database.
*/

// initializes login variables for the db
$host = "localhost";
$database = "bank";
$db_username = "root";
$db_password = "";


// establish a connection to the sql server
$conn = mysqli_connect($host, $db_username, $db_password, $database);
// check the connection, if it fails exit the code
if (!$conn) {
    die("Conn failed: " . $$conn->connect_error);
}


?>