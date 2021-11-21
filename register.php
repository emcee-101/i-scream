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
                <img src="assets/images/logo/i-scream-logo-red.png" alt="" srcset="">
                <img src="assets/images/logo.png" alt="Site logo" title="Logo">
                <h3>Sign Up</h3>
                <span>to continue to I-Scream</span>
            </div>

            <form action="" method="post">
                <!-- TODO-HTML: add form inputs [first name, last name, username, email, password] and submit button for register form-->
            </form>
        </div>
    </div>
</body>

</html>