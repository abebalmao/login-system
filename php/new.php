<?php
    include_once 'header.php';
?>
        <div class="container">
            <div class="new-post">
                <h3 id="post-title">CREATE POST</h3>
                <div class="post-user">
                <?php 
                    // echo out the username so the user knows 
                    // which account they are writing the forum post
                    echo 'Posting as: ' . $_SESSION['userName'];
                ?>
                </div>
                <form method="post" action="../includes/new.inc.php">
                    <div class="form-row">
                        <input type="text" placeholder="Subject..." name="post_subject">
                    </div>
                    <div class="form-row">
                        <textarea name="post_content" cols="30" rows="10" placeholder="Content..."></textarea>
                    </div>
                    <div class="form-row">
                        <input type="submit" name="new_post"value="CREATE">
                    </div>
                </form>
            </div>
            <?php 
            // if statements to handle error messages sent from ../includes/registration.inc.php
            // creates a <p> with the error message inside
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'emptyInput') {
                    echo '<p> You forgot to fill in the form! </p>';
                }
                if ($_GET['error'] == 'statementFailed') {
                    echo '<p> Statement failed!</p>';
                }
                if ($_GET['error'] == 'none') {
                    echo '<p> Your post was created! </p>';
                }
            }        
        ?>
        </div>
