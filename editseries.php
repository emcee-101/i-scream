<?php
include("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
require_once("includes/header.php");
require_once("includes/footer.php");

session_start();

    $user_data = check_login($con);
    $isAdmin = check_admin($con);
?>


<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Add Series</title>
  </head>

  <body class="background5">


  <div class="box" id='cent' style="margin-top:-30em;">

          <h2 id="redfont">Edit a Series</h2><br>
          <form method="POST">

              <p>
              <input type= "radio" name = "add_series" value="add_series" checked>
              <label for="yes">Add a Series</label><br><br>

              <input type= "radio" name = "add_series" value="add_season" checked>
              <label for="add_season">Add a Season</label><br><br>

              <input type= "radio" name = "add_series" value="add_episode" checked>
              <label for="add_episode">Add an Episode</label><br><br>
               </p>

              <p>Series Title</p><input type="text" name="series_title" required><br><br>
              <p>Season</p><input type="number" min="1" max ="99" name="series_title" required><br></br>
              <p>Episode</p><input type="number" min="1" max ="99" name="episode_number" required><br><br>
              <p>Episode Title</p> <input type="text" name="episode_title" required><br><br>
              <p>Description</p><textarea class= "inputbox" input type="text" name="movie_description"></textarea><br><br>
              <p>Reference Link</p><input type="text" name="series_img_link" required><br><br>
              <p>Video Group</p><input type="text" name="series_group" required><br><br>
              <p>Embed Code</p><input type="text" name="embed_code" required><br><br>

              <input type="submit" class="button button1" value="Submit"><br><br>
          </form>
  </div>

  </body>

</html>