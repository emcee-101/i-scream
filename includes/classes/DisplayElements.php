 
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


                $str = "<h3 id='whitefont'>".$this->title."</h3>";
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
        private $isInWatchlist;
        private $location; // 1 for movies site, 2 for Series, 3 for watchlist
        private $arrayOfGroupID;

        public function getWatchListModule() {

            // Workaround: transmits current GroupIDs, so tehy can be redisplayed, after something is added or eremoved from the watchlist (not inside of the watchlist (location 3) tough)
            $tstr = "";

            if(($this->location != 3) AND ($this->location != 4)){
                foreach($this->arrayOfGroupID as $key => $value){

                    $tstr .=  $value[0].":";

                }
            }
            // submit action to watchlist.php per php "get" when clicked
            $str = "<a href='watchlist.php?action=status&ent_id=".$this->ent_ID."&loc=".$this->location."&objlist=".$tstr."';>";

            // if already watchlisted: ask to remove
            if ($this->isInWatchlist == 1){
                    $str .= "<h4 class='addwatchlist'>- Remove from Watchlist</h4>";
            }
            else{
                    $str .= "<h4 class='addwatchlist'>+ Add to Watchlist</h4>";
            }


            $str .= "</a>";
            return $str;

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
        public function __construct($imgurl, $ent_id, $location, $arrayOfGroupID){

            $this->img = $imgurl;
            $this->ent_ID = $ent_id;
            $this->location = $location;
            $this->isInWatchlist = checkIfWatchlisted($_SESSION['usr_id'],$this->ent_ID);
            $this->arrayOfGroupID = $arrayOfGroupID;



        }

    }


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

  class SiteGenerator{

  private $bodyClass = "";
  private $bodyID = "";
  private $pageTitle = "";

  public function generateSiteStart(){
  $str ="<!DOCTYPE html>
         <html lang='en'>
         <meta charset='UTF-8'>
         <title>".$this->pageTitle."</title>
         <meta name='viewport' content='width=device-width,initial-scale=1, maximum-scale=2.00, minimum-scale=1.00 ,'>
         <link rel='stylesheet' href='assets/css/style.css'>
         <script src='assets/css/js/script.js'></script>
         <body class=".$this->bodyClass." ".$this->bodyID.">";

   echo $str;
  }

  public function generateSiteEnd(){
  $str =  "</body></html>";
  echo $str;
  }

  public function setBodyClass($bodyClass){
    $this->bodyClass = $bodyClass;
  }

  public function setBodyID($bodyID){
      $this->bodyID = $bodyID;
  }

  public function __construct($pageTitle, $bodyClass){
         $this->bodyClass = $bodyClass;
         $this->pageTitle = $pageTitle;
         }
  }

  class ticketDisplayer{

  private $con;
  private $ticketTable;
  private $ticketID;
  private $userID;
  private $username;
  private $ticketTopic;
  private $ticketDescription;


  public function printTicket(){
  $str = "<div class='ticketBox'><form method ='POST'>
            <h4 id='whitefont'>".$this->ticketTopic."</h4><br>
            <p>Ticket ID: ".$this->ticketID."<br>
            ".$this->username." (User ID: ".$this->userID.")<br><br>
            ".$this->ticketDescription."<br>
            <textarea class='answerBox' input type='text' name='series_description'></textarea><br><br>
            </p>

            <input type='submit' class='button button1' style ='width:100%;'value='Reply'><br><br>
            </form></div>";
   echo $str;
  }
  public function setUsername($con, $userID)
  {
    $query = "select username from user where user_id = '$this->userID'";
    $sql = mysqli_query($con, $query);
    $rs = mysqli_fetch_assoc($sql);
    $this->username = $rs['username'];
  }

  public function __construct($con,$ticketTable, $ticketID, $userID, $ticketTopic, $ticketDescription){
  $this->con = $con;
  $this->ticketTable = $ticketTable;
  $this->ticketID = $ticketID;
  $this->userID = $userID;
  $this->ticketTopic = $ticketTopic;
  $this->ticketDescription = $ticketDescription;
  }

  }

?>
