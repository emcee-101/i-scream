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

    <title>Welcome to IScream</title>
    <link rel="stylesheet" href="assets/css/style.css">



</head>
<body class="background5">

    <br>
    <?php


    // Slideshow

    class SliderElement {
        private $img ="";
        private $ID;

        public function getWatchLink() {

            $WatchLink = "";
            $WatchLink .= "watch.php?id=".$this->ID;

            return $WatchLink;
        }

        public function getString() {
            $str = "<div class='slide crop'>";
            $str .= "<p hidden>".$this->ID."</p>";
            $str .= "<a href='".$this->getWatchLink()."'>";
            $str .= "<img src='".$this->img."'><img>";
            $str .= "</a>";

            return $str;
        }
        public function __construct($imgurl, $IDNum){
            $this->img = $imgurl;
            $this->ID = $IDNum;
        }

    }



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

    // Boxes pf Movie reccomendations at the bottom of the screen

    class BoxElement {
        private $img ="";
        private $ID;
        private $caption="";

        public function getWatchLink() {

            $WatchLink = "";
            $WatchLink .= "watch.php?id=".$this->ID;

            return $WatchLink;
        }

        public function getString() {
            $str = "<div class='movierec_element'>";
            $str .= "<a href='".$this->getWatchLink()."'>";
            $str .= "<figure>";
            $str .= "<img class='thumbnail' src='".$this->img."'></img>";
            $str .= "<figcaption>".$this->caption."</figcaption>";
            $str .= "</figure></a></div>";
            return $str;


        }
        public function __construct($imgurl, $IDNum, $title){
            $this->img = $imgurl;
            $this->ID = $IDNum;
            $this->caption = $title;
        }

    }


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
        echo "</div>";
 ?>

</body>
</html>
