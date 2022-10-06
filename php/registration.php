<?php
    include_once 'header.php';
?>
        <div class="container">
            <div class="login-content">
                <h2>REGISTRATION</h2>
                <form method="post" action="../includes/registration.inc.php">
                    <div class="form-row">
                        <input type="text" placeholder="Username" name="user_name">
                    </div>
                    <div class="form-row">
                        <input type="password"
                        placeholder="Password" min="1" name="user_pass">
                    </div>
                    <div class="form-row">
                        <input type="password"
                        placeholder="Validate password" min="1" name="user_pass_val">
                    </div>
                    <div class="form-row">
                        <input type="submit" name="registration_button" value="CREATE ACCOUNT">
                    </div>
                </form>
            </div>
        </div>
        <?php 
            // if statements to handle error messages sent from ../includes/registration.inc.php
            // creates a <p> with the error message inside
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'emptyInput') {
                    echo '<p> You forgot to fill in the form! </p>';
                }
                if ($_GET['error'] == 'differentPwd') {
                    echo '<p> Passwords dont match! </p>';
                }
                if ($_GET['error'] == 'userExist') {
                    echo '<p> User allready exists! </p>';
                }
                if ($_GET['error'] == 'none') {
                    echo '<p> Account created! </p>';
                }
            }        
        ?>

<?php
    include_once 'footer.php'
?>