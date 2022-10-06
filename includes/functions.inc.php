<?php
/*
    collection of functions used in the program
*/

function emptyInputRegistration($username, $pwd, $pwd_val) {
    // checks if the variables $username $pwd and $pwd_val are empty  
    if (empty($username) || empty($pwd) || empty($pwd_val)) {
        $emptyInputRegistration_result = true;
    } else {
        $emptyInputRegistration_result = false;
    }
    return $emptyInputRegistration_result;
}

function emptyInputLogin($username, $pwd) {
    // checks if the variables $username and $pwd are empty
    if (empty($username) || empty($pwd)) {
        $emptyInputLogin_result = true;
    } else {
        $emptyInputLogin_result = false;
    }
    return $emptyInputLogin_result;
}

function emptyInputPosts($subject, $content) {
    // checks if the variables $subject and $content are empty
    if (empty($subject) || empty($content)) {
        $emptyInputPosts_result = true;
    } else {
        $emptyInputPosts_result = false;
    }
    return $emptyInputPosts_result;
}

function differentPwd($pwd, $pwd_val) {
    // checks if $pwd and $pwd_val match
    if ($pwd !== $pwd_val) {
        $differentPwd_result = true;
    } else {
        $differentPwd_result = false;
    }
    return $differentPwd_result;
}

function userExist($conn, $username) {
    // checks if the user exists in the db
    $query = "select * from users where userName = ?;";
    $statement = mysqli_stmt_init($conn);
    // if statement to stop sql injection
    if (!mysqli_stmt_prepare($statement, $query)) {
        header('location: ../php/registration.php?error=stamementFailed');
        exit();
    }

    // binds the statement and executes it after it was checked for sql injection
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);


    // saves the result in variable for later use
    $userExist_result = mysqli_stmt_get_result($statement);
    
    // if user exist, return the users login information
    // if user doesnt exist, return false
    if ($row = mysqli_fetch_assoc($userExist_result)) {
        return $row;
    } else {   
        $userExist_result = false;
        return $userExist_result;
    }
    mysqli_stmt_close($statement);
}

function createUser($conn, $username, $pwd, $pwd_val) {
    // add user to the db
    $query = "insert into users (userName, userPass) values (?, ?);";
    $statement = mysqli_stmt_init($conn);
    // if statement to stop sql injection
    if (!mysqli_stmt_prepare($statement, $query)) {
        header('location: ../php/registration.php?error=stamementFailed');
        exit();
    }

    // creates a hashed password
    $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);
    // binds the statement and executes it after it was checked for sql injection
    mysqli_stmt_bind_param($statement, 'ss', $username, $pwd_hashed);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header('location: ../php/registration.php?error=none');

}
function loginUser($conn, $username, $pwd) {
    // login user to the db
    // checks if a user with that username exist in db
    // if so, save this user in this variable
    $userExist = userExist($conn, $username);
    // if user doesnt exist, send them back to login.php with a error message
    if ($userExist === false) {
        header('location: ../php/login.php?error=userDoesntExist');
        exit();  
    }

    // gets the hashed user password
    $pwdHashed = $userExist['userPass'];
    $checkPwd = password_verify($pwd, $pwdHashed);
    // if passwords dont match
    if ($checkPwd === false) {
        header('location: ../php/login.php?error=wrongPassword'); //TODO: fix this
        exit();
    // if passwords match
    } else if ($checkPwd === true) {
        // create a new session for the user
        session_start();
        $_SESSION['userName'] = $userExist['userName'];
        header('location: ../php/index.php');
        exit();
    }
}

function echoPosts($conn, $html) {
    // echo out all the forum posts saved in the database
    // array with custom html tags to be replaced by str_replace
    $tags_array = array('---id---', '---subject---', '---comment---', '---time---', '---user---');
    // creating sql query that gathers the information stored in the table 'posts'
    $query = "select * from posts";
    // execute query
    $queryResult = mysqli_query($conn, $query);

    // as long as number of rows is above 0
    if ($queryResult -> num_rows > 0) {
        // loop through the rows
        while ($row = $queryResult -> fetch_assoc()) {
            // and replace the custom html tags with the information stored in the rows
            $html_posts = str_replace($tags_array, $row, $html);
            // echo it out
            echo $html_posts;
        }
    }
}

function createPost($conn, $subject, $content, $user) {
    // add post to db
    $date = date('Y-m-d H:i:s');
    $query = "insert into posts (subject, content, date, user) values (?, ?, '$date', ?)";
    $statement = mysqli_stmt_init($conn);

    // if statement failed add a error message to the header
    if (!mysqli_stmt_prepare($statement, $query)) {
        header('location: ../php/new.php?error=statementFailed');
        exit();
    }

    // bind statement and execute it
    mysqli_stmt_bind_param($statement, 'sss', $subject, $content, $user);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    // set header to show no error messages
    header('location: ../php/new.php?error=none');
}


