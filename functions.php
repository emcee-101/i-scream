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


function getBanner(){

        include("connection.php");


        //get a banner with id
        $query = "SELECT `id`, `image_path` FROM `banner_images` LIMIT 3;";

        $parsed_query = mysqli_query($con, $query);

        $results = array();

        $results = mysqli_fetch_all($parsed_query, MYSQLI_ASSOC);



                /* associative array - how the data can be read:*/
//        echo $results[0]["id"].$results[0]["image_path"]."\n";
//        echo $results[1]["id"].$results[1]["image_path"];

        return $results;

    }


function getGroup($WantMovie){

        include("connection.php");
        // to test it get Group with id = 1
        $VidGrID = 1;
        //get a Title of a Group of titles by id of group (AKA video_group_id)

        $query = "SELECT title FROM video_group WHERE video_group_id = ".$VidGrID." and isMovies = ".$WantMovie." LIMIT 1;";

        $parsed_query = mysqli_query($con, $query)  ;
        $row =  mysqli_fetch_assoc($parsed_query);
        $title = $row["title"];

        $query = "SELECT entity_id FROM video_group_member WHERE video_group_id = ".$VidGrID.";";
        $parsed_query = mysqli_query($con, $query);

        //fetch all IDs of members of the vidoe group
        $results =  mysqli_fetch_all($parsed_query);

        $getGroupResult = array($title, $results);

        //at the receiving end: list($title, $results) = $getGroupResult


        return $getGroupResult;

        // Testcode:
        // list($title, $results) = getGroup(1);
        // echo $title."\n";
        // print_r($results);
        // Result: Slasher Horror Array ( [0] => Array ( [0] => 1 ) )


    }




function getMovieBoxInfos($id, $isMovie){

        include("connection.php");
        // to test it get Movie with id 1
        //$id = 1;
        //$isMovie = 1;

            //get a Title, Thumbnail from DB
        $query = "SELECT title, picture FROM entity WHERE entity_id = ".$id." and is_movie = ".$isMovie." LIMIT 1;";

        $parsed_query = mysqli_query($con, $query);

        $movData =  mysqli_fetch_assoc($parsed_query);


                /* associative array - how the data is returned:*/
//          echo $movData["title"].$movData["picture"]."\n";
//         print_r($movData);

    return $movData;



    }
?>
