<?php

include_once("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

session_start();

    $user_data = check_login();
    $isAdmin = check_admin();


?>

<!DOCTYPE html>
<html>
<head>

    <title>Welcome to IScream</title>
    <link rel="stylesheet" href="assets/css/style.css">



</head>
<body class="background5">

    <br>
    <?php


// moved Class SliderElement to /includes/classes/DisplayElements.php

    $slider = array();

    //load banners from the db
    $bannersToBeLoaded = 10;
    $banners = getBanner($bannersToBeLoaded);

    foreach($banners as $key){

        array_push($slider, new SliderElement($key["image_path"],$key["id"]));

    }

    //output of slides
    echo "<div class='fade-in'><div class='slideshow'>";
    foreach($slider as $key){
        $tmp=$key->getString();
        echo $tmp;

        //Javascript fucntions to move between slides
        echo "<a id='left' onclick='showPrevSlide()'>&#10094;</a>";
        echo "<a id='right' onclick='showNextSlide()'>&#10095;</a>";
        echo "<br>";
        echo "</div>";

    }

 ?>

    <script type="text/javascript" src="assets/js/slideshow.js">
    </script>


  <?php


  // moved Class BoxElement to /includes/classes/DisplayElements.php


    $arrayOfRandomIds = array();
    $BoxElements = array();

    // get Number of Entities in DB in TOTAL
    $numOfEntites = getNumOfEntities();

    // the number of Elements to be displayed
    $numOfBoxesOnScreen = 5;

    for($i=0;$i<$numOfBoxesOnScreen;$i++){

        //choose random Entity out of all available
        $tmpRand = rand(1,$numOfEntites);

        // get Thumbnail and title
        $BoxData = getEntityBoxInfos($tmpRand);

        array_push($BoxElements, new BoxElement($BoxData["picture"],$tmpRand ,$BoxData["title"]));

    }


    //output of image
    echo "<div class='movierec'>";
    foreach($BoxElements as $key){
        $tmp=$key->getString();
        echo $tmp;
    }

        echo "<br>";
        echo "</div></div></div>";

require_once("includes/header.php");
require_once("includes/footer.php");
 ?>

</body>
</html>
