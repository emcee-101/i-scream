<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("connection.php");
include("functions.php");

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
    
    // USER GREETING
    /*
    echo "<h3 id='whitefont'>Hello";
    echo "&nbsp";
    echo $user_data['username'];
    echo "!</h3><br>";
    */
    // Slideshow

    class SliderElement {
        private $img ="";
        private $ID =0;
        public function getString() {
            $str = "<div class='slide crop'>";
            $str .= "<p hidden>".$this->ID."</p>";
            $str .= "<img src='".$this->img."'><img>";

            return $str;
        }
        public function __construct($imgurl, $IDNum){
            $this->img = $imgurl;
            $this->ID = $IDNum;
        }

    }


    // Testdata
    $slider = array (
        new SliderElement("https://images.unsplash.com/photo-1543373014-cfe4f4bc1cdf?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aGlnaCUyMHJlc29sdXRpb258ZW58MHx8MHx8",0),
        new SliderElement("https://wallpaperaccess.com/full/533108.jpg",0),
        new SliderElement("https://images.pexels.com/photos/220769/pexels-photo-220769.jpeg",0),
    );

    //output of image
    echo "<div class='slideshow'>";
    foreach($slider as $key){
        $tmp=$key->getString();
        echo $tmp;

        echo "<a id='left' onclick='showPrevSlide()'>&#10094;</a>";
        echo "<a id='right' onclick='showNextSlide()'>&#10095;</a>";
        echo "<br>";
        echo "</div>";

    }

 ?>




    <script type="text/javascript" src="assets/js/slideshow.js">
    </script>


  <?php
    // Slideshow

    class BoxElement {
        private $img ="";
        private $ID =0;
        private $caption ="ya";
        public function getString() {
            $str = "<div class='movierec_element'>";
            $str .= "<figure>";
            $str .= "<img class='thumbnail' src='".$this->img."'></img>";
            $str .= "<figcaption>".$this->caption."</figcaption>";
            $str .= "</figure></div>";
            return $str;


        }
        public function __construct($imgurl, $IDNum){
            $this->img = $imgurl;
            $this->ID = $IDNum;
            // CAPTION?
        }

    }


    // Testdata
    $boxview = array (
        new boxElement("https://designhub.co/wp-content/uploads/2020/06/MainBanner.png",0),
        new boxElement("https://designhub.co/wp-content/uploads/2020/06/MainBanner.png",0),
        new boxElement("https://designhub.co/wp-content/uploads/2020/06/MainBanner.png",0),
    );

    //output of image
    echo "<div class='movierec'>";
    foreach($boxview as $key){
        $tmp=$key->getString();
        echo $tmp;
    }

        echo "<br>";
        echo "</div>";
 ?>

</body>
</html>
