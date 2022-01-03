
  <?php



        include("connection.php");
        include("functions.php");

        list($title, $results) = getGroup(1, 1);
        echo $title;
        print_r($results);

  ?>

