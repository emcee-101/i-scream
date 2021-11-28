 <?php

// Utility Class
 class FormSanitization{

    public static function SanitizeMail($input){

        $sanitized_input = filter_var($input, FILTER_SANITIZE_EMAIL);
        return $sanitized_input;

    }

    public static function SanitizeString($input){

        $sanitized_input_a = filter_var($input, FILTER_SANITIZE_STRING);
        $sanitized_input_b = filter_var($sanitized_input_a, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        return $sanitized_input_b;
    }

    public static function SanitizeInt($input){

        $sanitized_input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        return $sanitized_input;
    }


// input from register.php
    public static function SanitizeRegistration($input_Arr){

        $sanitized_uname = self::SanitizeString($input_Arr["uname"]);
        $sanitized_name = self::SanitizeString($input_Arr["name"]);
        $sanitized_pass = self::SanitizeString($input_Arr["pass"]);
        $sanitized_mail = self::SanitizeMail($input_Arr["email"]);
        $sanitized_age = self::SanitizeInt($input_Arr["age"]);

        $sanitized_input_arr = array("uname" => $sanitized_uname, "name" => $sanitized_name, "pass" => $sanitized_pass, "email" => $sanitized_mail, "age" => $sanitized_age);
        return $sanitized_input_arr;
    }


// input from login.php
    public static function SanitizeLogin($input_Arr){

        $sanitized_uname = self::SanitizeString($input_Arr["uname"]);
        $sanitized_pass = self::SanitizeString($input_Arr["pass"]);

        $sanitized_input_arr = array("uname" => $sanitized_uname, "pass" => $sanitized_pass);
        return $sanitized_input_arr;
    }

}

// Test der Funktionen
/*
$testa = array("uname" => "bam</r>", "name" => "Thomas Hamster", "pass" => "$%adafwaf!", "email" => "osos<a//>ada321@gmail.com", "age" => 21);

$testb = FormSanitization::SanitizeRegistration($testa);


print_r($testb);
*/

?>






