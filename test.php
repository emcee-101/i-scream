
  <?php


        class vidBoxWrapper {
            private $title ="";
            private $grID =0;
            private $vidGroupElements = array();

            private function getVidBoxElements(){
                $tmp = "";
                echo "bubatz";
               foreach($this->vidGroupElements as $element){
                    echo "bubatz";
                    $tmp .= $element->getString();
               }
                return $tmp;
            }

            public function getString() {

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
    $test = array(
        new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1),
        new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1),
        new vidBoxElement("https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg",1)
            );
    $test2 = new vidBoxWrapper("Halloween Special", 1, $test);
    echo $test2->getString();

  ?>

