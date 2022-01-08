<?php


function check_login($con)
{
    // Check if User is in database0000000000000000
    if(isset($_SESSION['username']))
    {
        $user_name = $_SESSION['username'];
        $query = "select * from user where username = '$user_name' limit 1";

        /*read from database*/
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {


            $user_data = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $user_data;
        }
    }
    //redirect to login if session value does not exist
    header("Location: login.php");
    die;
}

function check_admin($con)
{
    if(isset($_SESSION['username']))
    {

    // check if user is admin

    $user_name = $_SESSION['username'];
    $query = "select isAdmin from user where username = '$user_name'";

    $result = mysqli_query($con, $query);

    $isAdmin = mysqli_fetch_assoc($result);

    if($isAdmin["isAdmin"] == 1)
    {
         echo "<a href='addcontent.php' class='button button1' style='width:100px;'>Edit Entities</a>";
    }
    else
    {
        echo "You are just a filthy casual";
    }
    }

}


function getBanner($numOfBanners){

        include("connection.php");


        //get 3 banner with id
        $query = "SELECT `id`, `image_path` FROM `banner_images` LIMIT ".$numOfBanners.";";

        $parsed_query = mysqli_query($con, $query);

        $results = array();

        $results = mysqli_fetch_all($parsed_query, MYSQLI_ASSOC);



                /* associative array - how the data can be read:*/
//        echo $results[0]["id"].$results[0]["image_path"]."\n";
//        echo $results[1]["id"].$results[1]["image_path"];

        return $results;

    }


function getRandomGroupIDs($wantMovies, $numOfWantedGroups){

    // designed to be used to pick groups to view in movies.php or series.php

        include("connection.php");

        $query = "SELECT video_group_id FROM video_group WHERE isMovies = ".$wantMovies;

        $parsed_query = mysqli_query($con, $query);

        $numRows = mysqli_num_rows($parsed_query);

        $results =  mysqli_fetch_all($parsed_query);

        $arrayOfGroupIds = array();

        $iterateUntil = $numOfWantedGroups;

        for ($i = 1; $i <= $iterateUntil; $i++){

            //select a random row from the result set
            $randomRow = $results[rand(0,$numRows-1)];

            array_push($arrayOfGroupIds , $randomRow);

        }

        return $arrayOfGroupIds;

        // Testcode
        // $results = getRandomGroupIDs(1,1);
        // print_r($results);

}

function getGroup($GrID , $WantMovie){

        include("connection.php");

        $VidGrID = $GrID;
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
        // list($title, $results) = getGroup(1, 1);
        // echo $title."\n";
        // print_r($results);
        // Result: Slasher HorrorArray ( [0] => Array ( [0] => 1 ) [1] => Array ( [0] => 3 ) )


    }




function getEntityBoxInfos($id){

        include("connection.php");
        // to test it get Movie with id 1
        //$id = 1;
        //$isMovie = 1;

        //get a Title, Thumbnail from DB
        $query = "SELECT title, picture FROM entity WHERE entity_id = ".$id." LIMIT 1;";

        $parsed_query = mysqli_query($con, $query);

        $movData =  mysqli_fetch_assoc($parsed_query);


                /* associative array - how the data is returned:*/
//          echo $movData["title"].$movData["picture"]."\n";
//         print_r($movData);

    return $movData;



    }


function getWatchURL ($ent_id)
{
    $url = "";
    $url = "watch.php?id=".strval($ent_id);
    return $url;
}


function getWatchList ($usr_id)
{

        include("connection.php");

        $query = "SELECT entity_id FROM watchlist WHERE user_id = ".$usr_id;

        $parsed_query = mysqli_query($con, $query);

        $results =  mysqli_fetch_all($parsed_query);


    return $results;

    //    $temp = getWatchList (1);
    //     print_r($temp);
    //     Array ( [0] => Array ( [0] => 1 ) [1] => Array ( [0] => 3 ) )


};


function checkIfWatchlisted($usr_id, $ent_ID){

        include("connection.php");

        $query = "SELECT COUNT(*) FROM watchlist WHERE user_id = ".$usr_id." AND entity_id =".$ent_ID;

        $parsed_query = mysqli_query($con, $query);
        $row = mysqli_fetch_array($parsed_query, MYSQLI_NUM);
        $value = $row[0];

        if($value > 0)
        {
            //already watchlisted = entry in watchlist table
            $returnValue=1;
        }
        else
        {
            $returnValue=0;
        }

    return $returnValue;


}

// adds or removes watchlist-status for a movie or tv show for one certain user
function toggleWatchlist($usr_id, $ent_ID){

    include("connection.php");
    $curState = checkIfWatchlisted($usr_id, $ent_ID);

     $queryAdd = "insert into watchlist (user_id,entity_id) values (".$usr_id.",".$ent_ID.");";
     $querySub = "delete from watchlist where user_id=".$usr_id." and entity_id=".$ent_ID.";";



    if($curState == 0)
    {
            //not watchlisted -> gets added
        mysqli_query($con, $queryAdd);
    }
    else
    {
        //already watchlist -> gets removed
        mysqli_query($con, $querySub);
    }


}

// gets total number of entries in Entity in DB
function getNumOfEntities(){

    include("connection.php");

    $query = "SELECT COUNT(*) FROM entity";

    $parsed_query = mysqli_query($con, $query);
    $row = mysqli_fetch_array($parsed_query, MYSQLI_NUM);
    $numOfEntities = $row[0];


    return $numOfEntities;

}


function getWatchScreen($ent_ID){

    include("connection.php");

    $query = "SELECT title,description,picture FROM entity where entity_id=".$ent_ID.";";
    $parsed_query = mysqli_query($con, $query);

    $result = mysqli_fetch_assoc($parsed_query);

    return $result;

}


?>
