<?php

        include("connection.php");

echo "1";
        //include("connection.php");
        // to test it get Group with id = 1
        $VidGrID = 1;

            //get a Title of a Group of titles by id of group (AKA video_group_id)

        $query = "SELECT title FROM video_group WHERE video_group_id = ".$VidGrID." and isMovies = ".$WantMovie." LIMIT 1;";

echo "1";
        $parsed_query = mysqli_query($con, $query);

echo "1";

   //     $title =  mysqli_fetch_assoc($parsed_query);
        $title =mysqli_fetch_object($parsed_query)->title;


echo "1";
        $query = "SELECT entity_id, title FROM video_group_member WHERE video_group_id = ".$VidGrID.";";
        $parsed_query = mysqli_query($con, $query);
        $results = array();

            //put lines of values in one array AS one array and repeat   array(array(value1,value2),array(value1,value2)) .....
        while ($line = mysqli_fetch_array($parsed_query, MYSQLI_ASSOC)) {
            $results[] = $line;
        }

                /* associative array - how the data is returned:*/
        echo $results[0]["entity_id"].$results[0]["title"]."\n";
        echo $results[1]["entity_id"].$results[1]["title"];





 ?>
