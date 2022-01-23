<?php
        include_once("connection.php");

 function edit_movies($POSTDATA)
{
    $con = establish_connection_db();
    $message = 0;

    // If edit value for movies was posted
    if(isset($POSTDATA['edit_movies']))
    {
        $edit = $POSTDATA['edit_movies'];
        $title = $POSTDATA['movie_title'];

        // Check in DB if movie is in there
        if(($edit != "add_movie") && (is_title_in_table($con,$title,1) == 0))
        {
            $message = $title." does not exist in the database. Please enter an existing movie title.";
            echo "<div class='fade-in'><p class='button'>".$message."</p></div>";
            return;
        }

        // Add, delete movie or edit movie description of existing movie according to edit value
        switch($edit)
        {
            case "add_movie":

                // Checks if all the necessary attributes were posted
                if ($POSTDATA['movie_description'] && $POSTDATA['release'] && $POSTDATA['thumbnail'] && $POSTDATA['movie_group'] && $POSTDATA['movie_embed'])
                {
                    // Sets posted data to local variables
                    $description = $POSTDATA['movie_description'];
                    $release = $POSTDATA['release'];
                    $thumbnail = $POSTDATA['thumbnail'];
                    $group = $POSTDATA['movie_group'];
                    $embed = $POSTDATA['movie_embed'];

                    //Check if group exists
                    $sql = "select video_group_id from video_group where title = '$group' AND isMovies = 1 limit 1";
                    $result = mysqli_query($con,$sql);
                    $groupAssoc = mysqli_fetch_assoc($result);

                    if($groupAssoc != 0)
                    {
                        // Inserts into Entities Table
                        $query = "insert into entity(title,description,picture,is_movie) values ('$title','$description','$thumbnail', 1) ";
                        $result = mysqli_query($con,$query);

                        // Selects entity id corresponding with the given title
                        $sql = "select entity_id from entity where title = '$title' AND is_movie = 1 limit 1";
                        $result = mysqli_query($con,$sql);
                        $rs = mysqli_fetch_assoc($result);
                        $entity_id = $rs['entity_id'];

                        // Adds values into movies table
                        $query = "insert into movies(entity_id, release_year, video_embed) values ('$entity_id','$release','$thumbnail')";
                        $result = mysqli_query($con,$query);
                        $message = "".$title." was added.";

                        // Adds remaining values into video_group_member table
                        $video_group_id = $groupAssoc['video_group_id'];
                        $query = "insert into video_group_member (video_group_id, entity_id) values('$video_group_id', '$entity_id')";
                        $result = mysqli_query($con,$query);

                        $message = "Video Group with Title ".$group." found for movies.";
                        break;
                    }
                    else
                    {
                     $message = "No Video Group with Title ".$group." found for movies.";
                     break;
                    }

                }

                else
                {
                    $message = "Please fill out the whole form to add a movie.";
                    break;
                }

            case "delete_movie":
                if (isset($POSTDATA['movie_title']))
                {
                    delete_entity($con, $title, 1);
                    $message = "".$title." was deleted.";
                }
                else
                {
                    $message ="Please enter an existing Movie title.";
                }
                break;

            case "edit_description":
                if ($POSTDATA['movie_description'] != "" && isset($POSTDATA['movie_title']))
                {
                    edit_entity_description($con, $title, 1, $POSTDATA['movie_description']);
                    $message = "Description of ".$title." was changed.";
                    break;
                }

                else
                {
                    $message = "Please enter an existing title and a description.";
                }
        }
    }
    if($message)
    {
        echo"<div class='fade-in'><p class='button'>".$message."</p></div>";
    }
    abolish_connection_db($con);
}

function edit_series($POSTDATA)
{
  $con = establish_connection_db();
  $message = 0;

  // If radios were filled out
  if(isset($POSTDATA['edit_value']) && isset($POSTDATA['edit_series']))

    // Which title
     if($POSTDATA['series_title'])
    {
        $editValue = $POSTDATA['edit_value'];
        $itemType = $POSTDATA['edit_series'];
        $title = $POSTDATA['series_title'];

        // Check in DB if title is in there
        if(($editValue != "add") && (is_title_in_table($con,$title,0) == 0))
        {
            $message = $title." does not exist. Please enter an existing series title.";
            echo "<div class='fade-in'><p class='button'>".$message."</p></div>";
            return;
        }

        // Add, delete movie or edit series description of existing movie according to edit value
        switch($editValue)
        {
            case "add":

                // Checks if conditions to add series are fulfilled
                if ($POSTDATA['season_number'] && $POSTDATA['episode_number'] && $POSTDATA['series_description'] && $POSTDATA['thumbnail'] && $POSTDATA['series_group'] && $POSTDATA['embed_code'])
                {
                    // Sets posted data to local variables
                    $season = $POSTDATA['season_number'];
                    $episode = $POSTDATA['episode_number'];
                    $description = $POSTDATA['series_description'];
                    $start = $POSTDATA['start_year'];
                    $thumbnail = $POSTDATA['thumbnail'];
                    $group = $POSTDATA['series_group'];
                    $embed = $POSTDATA['embed_code'];


                    // Check if video group exists
                    $sql = "select video_group_id from video_group where title = '$group' AND isMovies = 0 limit 1";
                    $result = mysqli_query($con,$sql);
                    $groupAssoc = mysqli_fetch_assoc($result);

                    if($groupAssoc != 0)
                    {
                        // Inserts into Entities Table
                        $query = "insert into entity(title,description,picture,is_movie) values ('$title','$description','$thumbnail', 0) ";
                        $result = mysqli_query($con,$query);

                        // Selects entity id corresponding with the given title
                        $sql = "select entity_id from entity where title = '$title' AND is_movie = 0 limit 1";
                        $result = mysqli_query($con,$sql);
                        $rs = mysqli_fetch_assoc($result);
                        $entity_id = $rs['entity_id'];


                        // Adds values into video_group_member table
                        $video_group_id = $groupAssoc['video_group_id'];
                        $query = "insert into video_group_member (video_group_id, entity_id) values('$video_group_id', '$entity_id')";
                        $result = mysqli_query($con,$query);
                        var_dump($result);
                        $message = $title." was successfully added.";

                        // Adds remaining values into series table
                        $query = "insert into series(entity_id, start_year, season, episode, video_embed) values ('$entity_id','$start','$season','$episode','$embed')";
                        $result = mysqli_query($con,$query);
                        var_dump($result);

                        break;
                    }
                    else
                    {
                        $message = "No Video Group called ".$group." found for series.";
                        break;
                    }

                }

                else
                {
                    $message = "Please fill out the whole form to add a series.";
                    break;
                }

            case "delete":
                if (isset($POSTDATA['series_title']))
                {
                    delete_entity($con, $title, 0);
                    $message = "".$title." was deleted.";
                }
                else
                {
                    $message ="Please enter an existing series title.";
                }
                break;

            case "edit":
                if ($POSTDATA['series_description'] != "" && isset($POSTDATA['series_title']))
                {
                    edit_entity_description($con, $title, 0, $POSTDATA['series_description']);
                    $message = "Description of ".$title." was changed.";
                    break;
                }

                else
                {
                    $message = "Please enter an existing series title and a description.";
                    break;
                }
        }
    }
    if($message)
    {
        echo"<div class='fade-in'><p class='button'>".$message."</p></div>";
    }
    abolish_connection_db($con);
}

function edit_groups($POSTDATA)
{
    $con = establish_connection_db();
    $message = 0;
    if(isset($POSTDATA['edit_type']) && isset($POSTDATA['group_type']) && isset($POSTDATA['group_title']))
    {
        $editType = $POSTDATA['edit_type'];
        $groupType = $POSTDATA['group_type'];
        $groupTitle = $POSTDATA['group_title'];
        $POSTDATA['group_type'] == "movie_group" ? $isMovies = 1 : $isMovies = 0;


        // Check if Video Group exists when it is not to be added
        if($editType != "add_group")
        {
            $query = "select * from video_group where title = '$groupTitle' AND isMovies = ".$isMovies."";
            $result = mysqli_query($con,$query);
            $rs = mysqli_fetch_array($result);

            if($rs === 0)
            {
                $message = $title." does not exist. Please enter an existing series title.";
                echo "<div class='fade-in'><p class='button'>".$message."</p></div>";
                return;
            }
        }

        switch($editType)
        {
             case "add_group":
                 // Inserts new Group into video_group Table
                 $query = "insert into video_group(title,isMovies) values ('$groupTitle','$isMovies') ";
                 $result = mysqli_query($con,$query);
                 $message = "Group with the title ".$groupTitle." was added!";
                 break;

             case "delete_group":

                // Select Video Group ID for input values
                $sql = "select video_group_id from video_group where title = '$groupTitle' AND isMovies = '$isMovies' limit 1";
                $result = mysqli_query($con,$sql);
                $rs = mysqli_fetch_assoc($result);

                if ($rs != 0)
                {
                    //sets ID
                    $groupID = $rs['video_group_id'];

                    // Check if there are still members of that group left and give an error message if there are
                    $sql = "select * from video_group_member where video_group_id = '$groupID'";
                    $result = mysqli_query($con,$sql);

                    // If at least one Group member was found
                    if($result != 0)
                    {
                        $message = "There are still Members of that Group.";
                        break;
                    }

                    else
                    {
                        // Deletes Group from video_group Table
                        $query = "delete from video_group where video_group_id = '$groupID'";
                        $result = mysqli_query($con,$query);

                        // If there is a group associated with that ID
                        if ($result)
                        {
                            $message = $groupTitle." was successfully deleted.";
                            break;
                        }
                        else
                        {
                            $message = "Please enter the valid Group type for ".$groupTitle;
                            break;
                        }

                    }

                }
                else
                {
                    $message = "Please enter an existing Group.";
                    break;
                }

             case "edit_group_type":

             // Is there a group Id for an associated Title and Group Value?
             $sql = "select video_group_id from video_group where title = '$groupTitle' AND isMovies = '$isMovies' limit 1";
             $result = mysqli_query($con,$sql);
             $rs = mysqli_fetch_assoc($result);

             // If yes
             if ($rs != 0)
             {

                $groupID = $rs['video_group_id'];

                // Sets local to the opposite value of $isMovies to change it in the db
                $isMovies === 0 ? $isMoviesSwitch = 1: $isMoviesSwitch = 0;
                $sql = "update video_group set isMovies = '$isMoviesSwitch' where video_group_id = '$groupID'";
                var_dump($sql);
                $result = mysqli_query($con,$sql);

                $isMoviesSwitch === 1 ? $changedType = "movie" : $changedType = "series";
                $message = $groupTitle." is now a ".$changedType.".";

                break;
             }
             else
             {

                $message = "Please enter the correct group Type.";
                break;
             }
        }
    }
    else
    {
    $message = "Please fill out the whole form.";
    }

if($message)
    {
        echo"<div class='fade-in'><p class='button'>".$message."</p></div>";
    }
    abolish_connection_db($con);
}

function edit_account($userID, $POSTDATA)
{
    $con = establish_connection_db();
    if(isset($POSTDATA['newMail']))
        {
            $newMail = $POSTDATA['newMail'];
            $query = "update user set mail_address = '$newMail' where user_id ='$userID'";
            $result = mysqli_query($con,$query);
            header("Location: account-management.php?Mail=1");
        }

    if(isset($POSTDATA['newAge']))
            {
                $newAge = $POSTDATA['newAge'];
                $query = "update user set age = '$newAge' where user_id ='$userID'";
                $result = mysqli_query($con,$query);
                header("Location: account-management.php?Age=1");
            }

    if(isset($POSTDATA['newMembershipStatus']))
            {
                echo $POSTDATA['newMembershipStatus'];
                $newMembership = $POSTDATA['newMembershipStatus'];
                var_dump($newMembership);
                $newMembership == "Full Membership"? $newMembership = 1: $newMembership = 0;
                $query = "update user set isSubscribed = '$newMembership' where user_id ='$userID'";
                $result = mysqli_query($con,$query);
                var_dump($result);
                header("Location: account-management.php?Membership=1");
            }

   abolish_connection_db($con);
}

function edit_password($userID, $POSTDATA)
{
    $con = establish_connection_db();

    if(isset($POSTDATA['password1']) && isset($POSTDATA['password2']))
        {
            $password1 = $POSTDATA['password1'];
            $password2 = $POSTDATA['password2'];

            if($password1 != $password2)
            {
                $message = "Passwords must match!";
                echo "<div class='fade-in'><p class='button'>".$message."</p></div>";
            }

            else
            {
                $hashed_password = password_hash($password1,  PASSWORD_DEFAULT);
                $query = "update user set password = '$hashed_password' where user_id ='$userID'";
                $result = mysqli_query($con,$query);
                header("Location: account-management.php?Password=1");
            }
        }

   abolish_connection_db($con);

}


function print_edit_message()
{
    $con = establish_connection_db();
    $message = 0;

    if(isset($_GET["Membership"]))
    {
        $message = "You successfully changed your Membership!";
    }

    else if(isset($_GET["Mail"]))
    {
        $message = "You successfully changed your Email!";

    }
    else if(isset($_GET["Age"]))
    {
        $message = "You successfully changed your Age!";
    }
    else if(isset($_GET["Password"]))
    {
        $message = "You successfully changed your Password!";
    }

    if($message != 0)
    {
    echo "<div class='fade-in'><p class='button'>".$message."</p></div>";
    }

}


// $editValue must be 1 for movies, 0 for series
function delete_entity($con, $entityTitle, $editValue)
{

  $editTable = ($editValue === 1? "movies": "series");

    // Selects the entity id where the title is fitting
    $sql = "select entity_id from entity where title = '$entityTitle' AND is_movie = ".$editValue."";
    $result = mysqli_query($con,$sql);
    $rs = mysqli_fetch_assoc($result);
    $entity_id = $rs['entity_id'];

    // Deletes entry with this id from movies or series table
    $query = "delete from ".$editTable."  where entity_id = '$entity_id'";
    $result = mysqli_query($con,$query);

    // Deletes entry with this id from banner_images table
    $query = "delete from banner_images where entity_id = '$entity_id'";
    $result = mysqli_query($con,$query);

    // Deletes entry with this id from video_group_member table
    $query = "delete from video_group_member where entity_id = '$entity_id'";
    $result = mysqli_query($con,$query);

    // Deletes entry with this id from watchlist table
    $query = "delete from watchlist where entity_id = '$entity_id'";
    $result = mysqli_query($con,$query);

    // Deletes entry with this id from entity table
    $query = "delete from entity where entity_id = '$entity_id'";
    $result = mysqli_query($con,$query);
}

function is_title_in_table ($con, $entityTitle, $editValue)
{
    $query = "select * from entity where title = '$entityTitle' AND is_movie = ".$editValue."";
    $result = mysqli_query($con,$query);
    $rs = mysqli_fetch_array($result);
    return $rs;
}

function edit_entity_description($con, $entityTitle, $editValue, $entityDescription)
{
    $sql = "select entity_id from entity where title = '$entityTitle' AND is_movie =".$editValue." limit 1";
    $result = mysqli_query($con,$sql);
    $rs = mysqli_fetch_array($result);

    $entity_id = $rs['entity_id'];
    $query = "update entity set description = '$entityDescription' where entity_id = '$entity_id'";
    $result = mysqli_query($con,$query);
}

function replyTicket($ticketID, $POSTDATA)
{
    $con = establish_connection_db();

    if(isset($POSTDATA['ticket_reply']))
    {
        $reply = $POSTDATA['ticket_reply'];
        $query = "update ticket set reply = '$reply' where id ='$ticketID'";
        $result = mysqli_query($con,$query);
        header("Location: tickets.php?ticketID=".$ticketID."");
    }

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
            show_admin_button("Edit Movies","editmovies.php");
            show_admin_button("Edit Series", "editseries.php");
            show_admin_button("Edit Groups" ,"editgroups.php");
            show_admin_button("View Tickets", "tickets.php");

        }

    }

    abolish_connection_db($con);

}
function show_admin_button($buttonName, $buttonLink)
{
    echo "<a href='".$buttonLink."' class='button button1' style='width:100px; margin:10px;'>".$buttonName."</a>";
}

//function view tickets

// get banners for the slideshow in index.php
function getBanner($numOfBanners){

        $con = establish_connection_db();


        //get 3 banner with id
        $query = "SELECT `entity_id`, `image_path` FROM `banner_images` LIMIT ".$numOfBanners.";";

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


// get the description of a movie or a tv show
function getDescription($ent_id){

    $con = establish_connection_db();

    $query = "SELECT description FROM entity where entity_id=".$ent_id.";";

    $parsed_query = mysqli_query($con, $query);

    $result = mysqli_fetch_assoc($parsed_query);

    $description = $result["description"];

    abolish_connection_db($con);

    return $description;
}

?>
