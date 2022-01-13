<?php
        include_once("connection.php");

 function edit_movies($POSTDATA)
{
    $message = 0;
    $result ="";
    $con = establish_connection_db();
    //IMPORTANT: ITERATE THROUGH DB FIRST TO CHECK IF A MOVIE WITH THAT TITLE IS IN THERE

    // If edit value for movies was posted
    if(isset($POSTDATA['edit_movies']))
    {
        $edit = $POSTDATA['edit_movies'];
        $title = $POSTDATA['movie_title'];

        // Add, delete movie or edit movie description of existing movie according to edit value
        switch($edit)
        {
            case "add_movie":

                // Checks if all the necessary attributes were posted
                if (isset($POSTDATA['movie_description']) && isset($POSTDATA['release']) && isset($POSTDATA['thumbnail']) && isset($POSTDATA['movie_group']) && isset($POSTDATA['movie_embed']))
                {
                    $description = $POSTDATA['movie_description'];
                    $release = $POSTDATA['release'];
                    $thumbnail = $POSTDATA['thumbnail'];
                    $group = $POSTDATA['movie_group'];
                    $embed = $POSTDATA['movie_embed'];


                    echo"<p>add movie condition entered</p>";



                    // Inserts into Entities Table
                    $query = "insert into entity(title,description,picture,is_movie) values ('$title','$description','$thumbnail', 1) limit 1";
                    $result = mysqli_query($con,$query);

                    // Selects entity id corresponding with the given title
                    $sql = "select entity_id from entity where title = '$title' AND is_movie = 1 limit 1";
                    $result = mysqli_query($con,$sql);
                    $rs = mysqli_fetch_array($result);
                    $entity_id = $rs['entity_id'];

                    // Adds remaining values into movies table
                    $query = "insert into movies(entity_id, release_year, video_embed) values ('$entity_id','$release','$thumbnail')";
                    $result = mysqli_query($con,$query);
                    break;
                }

                else
                {
                    $message = "Please fill out the whole form to add a movie.";
                    break;
                }

            case "delete_movie":
                if (isset($POSTDATA['movie_title']))
                {
                    echo"<p>delete movie condition entered</p>";
                    $sql = "select entity_id from entity where title = '$title' AND is_movie = 1 limit 1";
                    $result = mysqli_query($con,$sql);
                    $rs = mysqli_fetch_array($result);
                    $entity_id = $rs['entity_id'];

                    // Deletes movie entry with this id from movies db
                    $query = "delete from movies where entity_id = '$entity_id'";
                    $result = mysqli_query($con,$query);

                    // Deletes movie entry with this id from entity db
                    $query = "delete from entity where entity_id = '$entity_id'";
                    $result = mysqli_query($con,$query);

                    $message ="Movie with the title ".$title." was successfully deleted.";
                }
                else
                {
                    $message ="Please enter an existing Movie title.";
                }
                break;

            case "edit_description":
                if (isset($POSTDATA['movie_description']) && isset($POSTDATA['movie_title']))
                {
                    $sql = "select entity_id from entity where title = '$title' AND is_movie = 1 limit 1";
                    $result = mysqli_query($con,$sql);
                    $rs = mysqli_fetch_array($result);
                    $entity_id = $rs['entity_id'];

                    $description = $POSTDATA['movie_description'];
                    $query = "update entity set description = '$description' where entity_id = '$entity_id'";
                    $result = mysqli_query($con,$query);
                    $message = "Edit was successful.";
                    break;
                }

                else
                {
                    $message = "Please enter an existing and a description.";
                }
        }
    }
    if($message)
    {
        echo"<div class='fade-in'><p class='button'>".$message."</p></div>";
    }
    return $result;

}


function check_login()
{

    $con = establish_connection_db();

    // Check if User is in database
    if(isset($_SESSION['username']))
    {
        $user_name = $_SESSION['username'];
        $query = "select * from user where username = '$user_name' limit 1";

        // read from database
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {


            $user_data = mysqli_fetch_assoc($result);
            mysqli_free_result($result);

            abolish_connection_db($con);

            return $user_data;
        }
    }

    abolish_connection_db($con);

    // Redirect to login if session value does not exist
    header("Location: login.php");
    die;
}


function check_admin()
{
    $con = establish_connection_db();


    if(isset($_SESSION['username']))
    {

        // check if user is admin

        $user_name = $_SESSION['username'];
        $query = "select isAdmin from user where username = '$user_name'";

        $result = mysqli_query($con, $query);

        $isAdmin = mysqli_fetch_assoc($result);

        if($isAdmin["isAdmin"] == 1)
        {
            echo "<a href='editmovies.php' class='button button1' style='width:100px; margin:10px;'>Edit Movies</a>";
            echo "<a href='editseries.php' class='button button1' style='width:100px; margin-top:20px;'>Edit Series</a>";
        }

    }

    abolish_connection_db($con);

}

// get banners for the slideshow in index.php
function getBanner($numOfBanners){

        $con = establish_connection_db();


        //get 3 banner with id
        $query = "SELECT `id`, `image_path` FROM `banner_images` LIMIT ".$numOfBanners.";";

        $parsed_query = mysqli_query($con, $query);

        $results = array();

        $results = mysqli_fetch_all($parsed_query, MYSQLI_ASSOC);



                /* associative array - how the data can be read:*/
            //        echo $results[0]["id"].$results[0]["image_path"]."\n";
            //        echo $results[1]["id"].$results[1]["image_path"];

        abolish_connection_db($con);
        return $results;

    }


    //  pick random groups to display in movies.php or series.php
function getRandomGroupIDs($wantMovies, $numOfWantedGroups){

        $con = establish_connection_db();


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

        abolish_connection_db($con);

        return $arrayOfGroupIds;

        // Testcode
        // $results = getRandomGroupIDs(1,1);
        // print_r($results);

}


    // get a Group of Movies or TV Shows with title and numeric id listing the entity ids of the entities that are part of the group
function getGroup($GrID , $WantMovie){

        $con = establish_connection_db();

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


        abolish_connection_db($con);

        return $getGroupResult;

        // Testcode:
        // list($title, $results) = getGroup(1, 1);
        // echo $title."\n";
        // print_r($results);
        // Result: Slasher HorrorArray ( [0] => Array ( [0] => 1 ) [1] => Array ( [0] => 3 ) )


    }



    // get The Data necessary for the Displays in movies.php
function getEntityBoxInfos($id){

        $con = establish_connection_db();

        // to test it get Movie with id 1
        //$id = 1;
        //$isMovie = 1;

        //get a Title, Thumbnail from DB
        $query = "SELECT title, picture FROM entity WHERE entity_id = ".$id." LIMIT 1;";

        $parsed_query = mysqli_query($con, $query);

        $movData =  mysqli_fetch_assoc($parsed_query);


                /* associative array - how the data is returned:*/
            //         echo $movData["title"].$movData["picture"]."\n";
            //         print_r($movData);

        abolish_connection_db($con);

        return $movData;



    }




    //get URL that refers to the watch.php with the correct entitity
function getWatchURL ($ent_id)
{
    $url = "";
    $url = "watch.php?id=".strval($ent_id);
    return $url;
}



// get full wathclist of a user as a numeric array of entity ids
function getWatchList ($usr_id)
{

        $con = establish_connection_db();

        $query = "SELECT entity_id FROM watchlist WHERE user_id = ".$usr_id;

        $parsed_query = mysqli_query($con, $query);

        $results =  mysqli_fetch_all($parsed_query);


    return $results;

    //    $temp = getWatchList (1);
    //     print_r($temp);
    //     Array ( [0] => Array ( [0] => 1 ) [1] => Array ( [0] => 3 ) )


};

// check if a entity (movie or series) is watchlsited by a certain user
function checkIfWatchlisted($usr_id, $ent_ID){

    $con = establish_connection_db();

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

        abolish_connection_db($con);
        return $returnValue;


}

// adds or removes watchlist-status for a movie or tv show for one certain user
function toggleWatchlist($usr_id, $ent_ID){

    $con = establish_connection_db();

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

    abolish_connection_db($con);

}

// gets total number of entries in Entity in DB
function getNumOfEntities(){

    $con = establish_connection_db();

    $query = "SELECT COUNT(*) FROM entity";

    $parsed_query = mysqli_query($con, $query);
    $row = mysqli_fetch_array($parsed_query, MYSQLI_NUM);
    $numOfEntities = $row[0];

    abolish_connection_db($con);
    return $numOfEntities;

}



// used in Kontakt.php to add a ticket to the Database
function newTicket($con, $topic, $description, $user_id){

    $con = establish_connection_db();


    $queryAdd = "insert into ticket (user_id, topic, description) values (".$user_id.",'".$topic."','".$description."');";

    mysqli_query($con, $queryAdd);

    abolish_connection_db($con);
}

// used in watch.php and retrieves every piece of data needed to display the site
function getWatchData($ent_id){

    $con = establish_connection_db();

    $query = "SELECT * FROM entity where entity_id=".$ent_id.";";

    $parsed_query = mysqli_query($con, $query);

    $result = mysqli_fetch_assoc($parsed_query);

    $returnValue = array();

    $returnValue = $result;



    if ($result["is_movie"]){

            $query = "SELECT * FROM movies where entity_id=".$ent_id.";";

            $parsed_query = mysqli_query($con, $query);

            $result = mysqli_fetch_assoc($parsed_query);

    }
    else{

            $query = "SELECT * FROM series where entity_id=".$ent_id.";";

            $parsed_query = mysqli_query($con, $query);

            $result = mysqli_fetch_all($parsed_query, MYSQLI_ASSOC);


    }

    $tmpArray = array();

                        //      [0]                     [1]         [2]
    array_push($tmpArray, $returnValue["is_movie"], $returnValue, $result);

        // [0] integer (0 or 1) that indicates wether the entity is a movie or a series

        // [1]  entity_id 	title 	description 	picture 	is_movie

        // [2] when movie:	id 	entity_id 	release_year 	video_embed

        // [2] when a series:  NUMERIC ARRAY WITH ALL ELMENTS OF SERIES WITH THE FOLLOWING ELEMENTS (associative) INSIDE THEM
                                        //  id 	entity_id 	start_year 	season 	episode 	video_embed


    $returnValue = $tmpArray;

    abolish_connection_db($con);

    return $returnValue;

    // returns a numeric array with entity results
}


// get a Youtube Embed Key and return the whole HTML segment to be embedded in the waatch.php
function getYTembed($embed_key){

    //Test if running correctly:
        //echo "<h3 id='whitefont'>".$embed_key."</h3>";

    // take the components that make a youtube embed and put the embed-key in the middle of them
    $tmpString = Constants::$YTembedStart.$embed_key.Constants::$YTembedEnd;


    return $tmpString;




}

?>
