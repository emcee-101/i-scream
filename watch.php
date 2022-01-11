<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/connection.php");
include("includes/functions.php");

session_start();

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Watch a Video</title>
    <link rel="stylesheet" href="assets/css/style.css">



</head>
<body class="background5">

    <br>

    <?php

        if (empty($_GET)){

            header('Location: index.php');
        }
        else{

            include("includes/classes/Constants.php");

            $Data = getWatchData($_GET["id"]);

            list($is_movie, $entity_data, $specific_data) = $Data;


            if($is_movie == 1){

                echo getYTembed($specific_data["video_embed"]);

            }
            else{

                $tmpString = "";

                foreach($specific_data as $key => $value){

                    // TESTa Output:
                        //echo "<h3 id='whitefont'>".print_r($specific_data[$key])."</h3>";
                            //Array ( [id] => 1 [entity_id] => 2 [start_year] => 2013 [season] => 1 [episode] => 0 [video_embed] => f_Y5YeYrqUk )
                            //Array ( [id] => 2 [entity_id] => 2 [start_year] => 2014 [season] => 2 [episode] => 0 [video_embed] => ZlMVVdw1a8w )


                    $tmpString .= getYTembed($value["video_embed"]);



                }

                echo $tmpString;
            }

        }


    ?>




</body>
</html>
