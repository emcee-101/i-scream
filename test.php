
  <?php



        include("connection.php");
      include("includes/functions.php");

    $temp = getWatchList (1);
    print_r($temp);
    Array ( [0] => Array ( [0] => 1 ) [1] => Array ( [0] => 3 ) )
  ?>

