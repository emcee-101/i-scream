<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
require_once("includes/header.php");
require_once("includes/footer.php");

session_start();

    $user_data = check_login();
    $isAdmin = check_admin();
    $SeriesEdit = edit_series($_POST);

    $HTML = new SiteGenerator("Edit Movies Page","background5");
    $HTML->generateSiteStart("Add Series","background5");
?>
  <div class="box">

          <h2 id="redfont">Edit a Series</h2><br>
          <form method="POST">

              <p>
              <input type= "radio" name = "edit_value" value="add" checked>
              <label for="add">Add</label>

              <input type= "radio" name = "edit_value" value="delete">
              <label for="delete">Delete</label>

              <input type= "radio" name = "edit_value" value="edit">
              <label for="edit">Edit Description</label><br><br>

              <input type= "radio" name = "edit_series" value="series" checked>
              <label for="series">A Series</label>

              <input type= "radio" name = "edit_series" value="episode">
              <label for="episode">An Episode</label><br><br>

              Series Title<br><input type="text" name="series_title" required><br><br>
              Season<br><input type="number" min="1" max ="99" name="season_number"><br><br>
              Episode<br><input type="number" min="1" max ="99" name="episode_number"><br><br>
              Description<br><textarea class= "inputbox" input type="text" name="series_description"></textarea><br><br>
              Start Year<br><input type="number" min="1900" max ="2021" name="start_year" ><br><br>
              Reference Link<br><input type="text" name="thumbnail"><br><br>
              Video Group<br><input type="text" name="series_group"><br><br>
              Embed Code<br><input type="text" name="embed_code"><br><br>
              </p>

              <input type="submit" class="button button1" value="Submit"><br><br>
          </form>

 <?php
  $HTML->generateSiteEnd() ?>

