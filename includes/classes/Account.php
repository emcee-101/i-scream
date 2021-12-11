<?php
class Account
{

    private $con;
    private $errorArray = array();

    public function __construct($con)
    {
        $this->con = $con;
    }

    /**
     * update user details in user table
     */

    public function updateDetails($fn, $ln, $em, $un)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewEmail($em, $un);

        if (empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE users SET firstName=:fn, lastName=:ln, email=:em
                                            WHERE username=:un");
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);

            return $query->execute();
        }

        return false;
    }

    /**
     * register new user 
     * validate user details
     * call insert function and insert new user
     */

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray)) {
            return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
        }

        return false;
    }

    /**
     * login user
     * hash password
     * match and get user from user table
     */

    public function login($un, $pw)
    {
        $pw = hash("sha512", $pw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if ($query->rowCount() == 1) {
            return true;
        }

        array_push($this->errorArray, Constants::$loginFailed);
        return false;
    }

    private function insertUserDetails($fn, $ln, $un, $em, $pw)
    {

        $pw = hash("sha512", $pw);

        $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password)
                                        VALUES (:fn, :ln, :un, :em, :pw)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        return $query->execute();
    }

    private function validateFirstName($fn)
    {
        if (strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($ln)
    {
        if (strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($un)
    {
        if (strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un", $un);

        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    private function validateEmails($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);

        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validateNewEmail($em, $un)
    {

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username != :un");
        $query->bindValue(":em", $em);
        $query->bindValue(":un", $un);

        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePasswords($pw, $pw2)
    {
        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if (strlen($pw) < 5 || strlen($pw) > 25) {
            array_push($this->errorArray, Constants::$passwordLength);
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

    public function getFirstError()
    {
        if (!empty($this->errorArray)) {
            return $this->errorArray[0];
        }
    }

    public function updatePassword($oldPw, $pw, $pw2, $un)
    {
        $this->validateOldPassword($oldPw, $un);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE users SET password=:pw WHERE username=:un");
            $pw = hash("sha512", $pw);
            $query->bindValue(":pw", $pw);
            $query->bindValue(":un", $un);

            return $query->execute();
        }

        return false;
    }

    public function validateOldPassword($oldPw, $un)
    {
        $pw = hash("sha512", $oldPw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if ($query->rowCount() == 0) {
            array_push($this->errorArray, Constants::$passwordIncorrect);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/css/js/script.js"></script>

    <title>Account </title>
 
</head>

<body> class= "background1" >
                <div id="logo" >
                        <img class ="headerlogo" src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png" style="height:100px; width:100px;"></img></a>
                    </div>
                    <div class = "box" id="cent">
        <h2 style="text-align:center" id="redfont">Account</h2><br>
        <form method="POST">

        <p class="center">Email</p><br><input type="text" name="email"><br><br>
            <p>Password</p><br><input type="password" name="password"><br><br><br>
            <p>Date of birth</p><br><input type="date" name="Date of birth"><br><br><br>
            <p>Sex</p><br><input type="radio" name="sex"><br><br><br>
            <p>Membership</p><br><input type="text" name="membership"><br><br><br>

            <input type="button" class="button button1" value="Account"><br><br><br>
            <input type="button" class="button button1" value="edit profile"><br><br><br>
          
        </form>
    </div>


</body>

</html>
