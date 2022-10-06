<?php
    include_once 'header.php';
    /*
        'main' webpage of the website which displays the forum posts
    */
    require_once '../includes/functions.inc.php';
    require_once '../includes/dbh.inc.php';

    // gets the html file
    $html = file_get_contents('../home.html');
    // explodes it into two parts
    $html_pieces = explode('<!--===xxx===-->', $html);
    // prints out the first part
    echo $html_pieces[0];

    // call the method echoPosts and pass in the database connection
    // and the part of the html file that will get shown on the website
    echoPosts($conn, $html_pieces[1]);
?>
