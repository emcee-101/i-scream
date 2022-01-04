<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("includes/connection.php");
include("includes/functions.php");

session_start();

    $user_data = check_login($con);

    // if ADD TO WATCHLIST CLICKED
 if($_SERVER['REQUEST_METHOD'] == "POST")
    {
         // ENtity ID to be inserted in user's watchlist
        $ent_id_watchlist = $_POST['ent_id'];


        $query = "insert into watchlist (ent_id,user_id) values ('".$ent_id_watchlist."','".$_SESSION['usr_id']."');";

        // insert
        mysqli_query($con, $query);
    }
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
        private $ent_ID;
        private $isInWatchlist = checkIfWatchlisted($_SESSION['usr_id'],$ent_ID);

        public function getWatchListModule() {

            echo "<a href='watchlist.php?action=status&ent_id=".$ent_id."'>";

            if ($isInWatchlist){
                    str = "<h4 class='addwatchlist'>- Remove from Watchlist</h4>";
            }
            else{
                    str = "<h4 class='addwatchlist'>+ Add to Watchlist</h4>";
            }

            echo str;

            echo "</a>"


        }

        public function getString() {

                    // print out image tag with correct source and basic styling

            $str = "<div>";
            $str .= "<a href=".getWatchURL($this->ent_ID).">";
            $str .= "<img class= 'videobox' src=".$this->img.">";
            $str .= "</a>";
            $str .= $this->getWatchListModule();
            $str .= "</div>";
            return $str;
        }
        public function __construct($imgurl, $ent_id){
            $this->img = $imgurl;
            $this->ent_ID = $ent_id;
        }

    }

    //TESTDATA!!!
            /*
                $test = array(
                    new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1),
                    new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1),
                    new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1)
                        );
                $test2 = new vidBoxWrapper("Halloween Special", 1, $test);
                echo $test2->getString();
            */



    //get IDs for Groups
                            // first PARAMETER = MOVIE (0 or 1)
                            // second PARAMETER = HOW MANY SHALL BE DISPLYED
    $arrayOfGroupID = getRandomGroupIDs(1, 2);

    foreach ($arrayOfGroupID as $key => $value){
        // get Data of each group


        $getGroupResult = getGroup($value[0], 1);

        //title and list of results of ids get assigned to proper names
        list($title, $results) = $getGroupResult;

        $groupElements = array();

         // get Data for each specific Movie that is shown
        foreach($results as $elemtNum => $id){

            // get picture dorm movie ID
            $tmp = getEntityBoxInfos($id[0]);

            array_push($groupElements, new vidBoxElement($tmp["picture"],$id[0]));

        }

        // create new object
        $OutputGroup = new vidBoxWrapper($title, $value, $groupElements);

        // print out
        echo $OutputGroup->getString();

    }




  ?>



</body>
</html>
