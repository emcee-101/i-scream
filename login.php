<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // something was posted
        $user_name = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($user_name)&& !empty($password) && !is_numeric($user_name))
        {
            //read from database & find user with the matching username
            $query = "select * from user where username = $user_name limit 1";

            $result = mysqli_query($con, $query);

            //if user was found check if password is correct
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['password'] === $password)
                    {
                      $_SESSION['id'] = $user_data['id'];
                      header("Location: index.php");
                      die;
                    }
                }
            }

        }

        else
        {
           echo "please enter some valid information";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="assets/css/style.css">
<script src="assets/css/js/scripts.js"></script>

    <title>Login</title>


</head>


<body>

   <div id ="cent">
       <h3>Login</h3><br>
       <form method = "post">
           <p class="center">Username</p><br><input type ="text" name="username" ><br><br>
           <p>Password</p><br><input type ="password" name="password"><br><br><br>


           <input type="submit" class="button button1" value = "Login"><br><br><br>
           <a href ="register.php" class="button button1" style="text-decoration: none">Register</a><br><br><br>
       </form>
   </div>


</body>
</html>