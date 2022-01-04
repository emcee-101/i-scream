 
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
        private $isInWatchlist;
        private $location; // 1 for movies site, 2 for Series, 3 for watchlist

        public function getWatchListModule() {

            // submit action to watchlist.php per php "get" when clicked
            $str = "<a href='watchlist.php?action=status&ent_id=".$this->ent_ID."&loc=".$this->location."'>";

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
        public function __construct($imgurl, $ent_id, $location){

            $this->img = $imgurl;
            $this->ent_ID = $ent_id;
            $this->location = $location;
            $this->isInWatchlist = checkIfWatchlisted($_SESSION['usr_id'],$this->ent_ID);




        }

    }



?>
