<?php

if (empty($_GET)) {
    // not a request for adding something to watchlist
    include_once("includes/connection.php");
    include("includes/functions.php");
    include("includes/classes/DisplayElements.php");
    session_start();

    $user_data = check_login();

}
else {

    include_once("includes/connection.php");
    include("includes/functions.php");

    session_start();

    $user_data = check_login();

    if ($_GET["action"]=="status"){

        toggleWatchlist($_SESSION["usr_id"],$_GET["ent_id"]);

    }


    $redirect_to = $_GET["loc"];

    switch($redirect_to){
        case 1:
            header('Location: movies.php?site=movies&objlist='.$_GET["objlist"]);
            break;
        case 2:
            header('Location: movies.php?site=series&objlist='.$_GET["objlist"]);
            break;
        case 3:
            header('Location: watchlist.php');
            break;
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class = "background4">

    <div class="fade-in">

        


    <?php

        //mark as watchlist for correct redirectment after editing watchlist
        $location = 3;


        //get IDs in Watchlist

        $arrayOfEntID = getWatchList($_SESSION["usr_id"]);

        $watchListElements = array();

         // get Data for each specific Movie that is shown
        foreach($arrayOfEntID as $elemtNum => $id){

            // get picture dorm movie ID
            $tmp = getEntityBoxInfos($id[0]);

            array_push($watchListElements, new vidBoxElement($tmp["picture"],$id[0],$location));

        }

        // create new object
        $OutputGroup = new vidBoxWrapper("My Watchlist", 0, $watchListElements);

        // print out
        echo $OutputGroup->getString();


    echo "</div>";

require_once("includes/header.php");
require_once("includes/footer.php");
?>

</body>
</html>
