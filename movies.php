<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("connection.php");
include("functions.php");

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

<body class="background3">
  <div class="fade-in">



  <?php
        // Class is Category of Movie or TV Show with title and basic styling and a property of an array of "vidBoxObjects"
        class vidBoxWrapper {
            private $title ="";
            private $grID =0;
            private $vidGroupElements = array();

            private function getVidBoxElements(){

                //print out the Output of getString() of each of the "vidGroupMem" elements in the Array

                $tmp = "";

               foreach($this->vidGroupElements as $element){

                    $tmp .= $element->getString();
               }
                return $tmp;
            }

            public function getString() {

                //print out wrapper

                $str = "<h3 id='whitefont' style='margin:5px;'>".$this->title."</h3>";
                $str .= "<div class='videowrapper'>";
                $str .= $this->getVidBoxElements();
                $str .= "</div>";
                return $str;
            }

            public function __construct($title, $grID, $vidGroupElements){
                $this->title = $title;
                $this->grID = $grID;
                $this->vidGroupElements = $vidGroupElements;
            }

    }


        class vidBoxElement {
        private $img ="";
        private $ent_ID = 0;
        public function getString() {

                    // print out image tag with correct source and basic styling

            $str = "<div >";
            $str .= "<img class= 'videobox' src='".$this->img."'>";
            $str .= "</div>";
            return $str;
        }
        public function __construct($imgurl, $ent_id){
            $this->img = $imgurl;
            $this->ent_id = $ent_id;
        }

    }

    //testdata

    $test = array(
        new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1),
        new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1),
        new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1)
            );
    $test2 = new vidBoxWrapper("Halloween Special", 1, $test);
    echo $test2->getString();
  ?>



</body>
</html>
