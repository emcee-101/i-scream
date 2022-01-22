<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

session_start();
$user_data = check_login();

$HTML = new SiteGenerator("Movies Page","background3");
$HTML->generateSiteStart();
?>
<div class ="fade-in">

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

    if(($_GET["action"] == "sub")AND(isset($_GET["mov"]))AND(isset($_GET["type"]))){

        $location = 4;
        // if a subcategory from the header got clicked do this!!!
        $showMovies = $_GET["mov"];

        $GROUP = $_GET["type"];
        $neededGroupID = 0;

        switch($GROUP){

            // assign the group id's from the db to the term
            case("science"):
                $neededGroupID = 8;
                break;

            case("slasher"):
                $neededGroupID = 1;
                break;

            case("haunted"):
                $neededGroupID = 3;
                break;

            default:
                // ERROR MESSAGE
                break;
        }

        $getGroupResult = getGroup($neededGroupID, $showMovies);

                //title and list of results of ids get assigned to proper names
        list($title, $results) = $getGroupResult;

        $groupElements = array();

        // get Data for each specific Movie that is shown
        foreach($results as $elemtNum => $id){

            // get picture dorm movie ID
            $tmp = getEntityBoxInfos($id[0]);

            array_push($groupElements, new vidBoxElement($tmp["picture"],$id[0],$location, $arrayOfGroupID));

            }

        // create new object
        $OutputGroup = new vidBoxWrapper($title, $value, $groupElements);

        // print out
        echo $OutputGroup->getString();

        }


    else{

        //the regular usage of movies.php (multiple categories)

        //get IDs for Groups

        $numGroups = 6;

        // Workaround to have same display after adding / removing from watchlist
        if(isset($_GET["objlist"])){
            $arrayOfGroupID = explode(":",$_GET["objlist"], $numGroups);
        }
                                    // first PARAMETER = MOVIE (0 or 1)
        else{                        // second PARAMETER = HOW MANY SHALL BE DISPLYED

            $arrayOfGroupID = getRandomGroupIDs($showMovies, $numGroups);
        }



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

                array_push($groupElements, new vidBoxElement($tmp["picture"],$id[0],$location, $arrayOfGroupID));

            }

            // create new object
            $OutputGroup = new vidBoxWrapper($title, $value, $groupElements);

            // print out
            echo $OutputGroup->getString();

        }

    echo "<h4 class='addwatchlist'>".$showMovies."</h4></div>";

    }

require_once("includes/header.php");
require_once("includes/footer.php");
$HTML->generateSiteEnd();
  ?>
