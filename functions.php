<?php

function check_login($con)
{
    // change attributes according to Niclas' Database

    // Check if User is in database
    if(isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
        $query = "select * from user where id = '$id' limit 1";

        /*read from database*/
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

    }
    else
    {
    //redirect to login if session value does not exist
    header("Location: login.php");
    die;
    }
}
