<?php
include_once("includes/connection.php");
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

session_start();
$user_data = check_login();

$HTML = new SiteGenerator("Watch a Video","background5");
$HTML->generateSiteStart();

if (empty($_GET)){

    header('Location: index.php');
}
else{

    include("includes/classes/Constants.php");

    $Data = getWatchData($_GET["id"]);

    list($is_movie, $entity_data, $specific_data) = $Data;


            echo "<div style='position: relative;max-width: 1000px;height: auto;width: auto;margin: auto;margin-top: 200px;align-self: center;left: 10%;'>";

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


    $description = $entity_data["description"];

    echo "<h3 id='whitefont'>".$description."</h3>";
    echo "</div>";
}

$HTML->generateSiteEnd();?>
