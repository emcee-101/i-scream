<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {
    // sanitize form data
}

/**
 * print out input values
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
                <h3>Sign Up</h3>
                <span>to continue to I-Scream</span>
            </div>

            <form action="" method="post">
                <!-- TODO-HTML: add form inputs [first name, last name, username, email, password] and submit button for register form-->
            </form>
            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        </div>
    </div>
</body>

</html>