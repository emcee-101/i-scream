<?php
include("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

session_start();

    $user_data = check_login($con);

?>

<html lang="de">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/css/js/script.js"></script>

</head>

<body class="background3" >
  <div class="fade-in">



  <?php


        // check if series screen or movies screen

      if ($_GET["site"] == "series")
      {
          $showMovies = 0;

          //mark as series tab for correct redirectment after editing watchlist
          $location = 2;
      }
      else
      {
         $showMovies = 1;

          //mark as movies tab for correct redirectment after editing watchlist
         $location = 1;
      }




  // MOVED CLASSES FOR BOXES TO includes/classes/DisplayElements.php

    //get IDs for Groups
                            // first PARAMETER = MOVIE (0 or 1)
                            // second PARAMETER = HOW MANY SHALL BE DISPLYED
    $arrayOfGroupID = getRandomGroupIDs($showMovies, 4);

    foreach ($arrayOfGroupID as $key => $value){
        // get Data of each group


        $getGroupResult = getGroup($value[0], $showMovies);

        //title and list of results of ids get assigned to proper names
        list($title, $results) = $getGroupResult;

        $groupElements = array();

         // get Data for each specific Movie that is shown
        foreach($results as $elemtNum => $id){

            // get picture dorm movie ID
            $tmp = getEntityBoxInfos($id[0]);

            array_push($groupElements, new vidBoxElement($tmp["picture"],$id[0],$location));

        }

        // create new object
        $OutputGroup = new vidBoxWrapper($title, $value, $groupElements);

        // print out
        echo $OutputGroup->getString();

    }

echo "<h4 class='addwatchlist'>".$showMovies."</h4></div>";

require_once("includes/header.php");
require_once("includes/footer.php");

  ?>



</body>
</html>
