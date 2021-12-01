<?php

function check_login($con)
{
    // Check if User is in database
    if(isset($_SESSION['username']))
    {
        $user_name = $_SESSION['username'];
        $query = "select * from user where username = '$user_name' limit 1";

        /*read from database*/
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

    }
    //redirect to login if session value does not exist
    header("Location: login.php");
    die;
}
