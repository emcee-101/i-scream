<?php
class Account
{

    private $con;
    private $errorArray = array();

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function updateDetails()
    {
    }

    public function register()
    {
    }

    public function login($username, $password)
    {
    }

    private function insertUserDetails()
    {
    }

    private function validateFirstName($firstname)
    {
        // TODO: validate length of first name
        // push error string to error array if validation fails
    }

    private function validateLastName($lastname)
    {
    }

    private function validateUsername($username)
    {
    }

    private function validateEmails($email, $email2)
    {
    }

    private function validateNewEmail($newemail, $username)
    {
    }

    private function validatePasswords($password, $password2)
    {
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return $error;
        }
    }

    public function getFirstError()
    {
    }

    public function updatePassword($oldpassword, $password, $password2, $username)
    {
    }

    public function validateOldPassword($oldPassword, $username)
    {
    }
}
