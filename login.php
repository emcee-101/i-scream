<?php

/**
 * 
 */
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Reeceflix</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="assets/images/logo/i-scream-logo-red.png" alt="Site logo">
                <h3>Sign In</h3>
                <span>to continue to I-Scream</span>
            </div>

            <form action="" method="post">
                <!-- TODO-HTML: add form inputs [username, password] and submit button for sign in form-->
            </form>
            <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>
        </div>
    </div>
</body>

</html>