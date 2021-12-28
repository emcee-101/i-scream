
  <?php

        include("connection.php");
        include("functions.php");

        $results = getBanner();
        echo $results[0]["id"].$results[0]["image_path"]."\n";
        echo $results[1]["id"].$results[1]["image_path"];

  ?>

