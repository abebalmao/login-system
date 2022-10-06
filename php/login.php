<?php
include_once 'header.php';
?>
        <div class="container">
            <div class="login-content">
                <h2>LOGIN</h2>
                <form method="post" action="../includes/login.inc.php">
                    <div class="form-row">
                        <input type="text" placeholder="Username" name="user_name">
                    </div>
                    <div class="form-row">
                        <input type="password"
                        placeholder="Password" min="1" name="user_pass">
                    </div>
                    <div class="form-row">
                        <input type="submit" name="login_button"value="LOGIN">
                    </div>
                </form>
            </div>
        </div>

        <?php 
            // if statements to handle error messages sent from ../includes/login.inc.php
            // creates a <p> with the error message inside
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'emptyInput') {
                    echo '<p> You forgot to fill in the form! </p>';
                }
                if ($_GET['error'] == 'userDoesntExist') {
                    echo '<p> This user doesnt exist!</p>';
                }
                if ($_GET['error'] == 'wrongPassword') {
                    echo '<p> Wrong password </p>';
                }
                if ($_GET['error'] == 'none') {
                    echo '<p> Account created! </p>';
                }
            }        
        ?>
<?php
    include_once 'footer.php';
?>