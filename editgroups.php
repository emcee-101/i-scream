<?php
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
require_once("includes/header.php");
require_once("includes/footer.php");

session_start();

    $user_data = check_login();
    $isAdmin = check_admin();
    $GroupsEdit = edit_groups($_POST);

    $HTML = new SiteGenerator("Video Group Edit","background5");
    $HTML->generateSiteStart();

?>

<div class="box">

        <h2 id="redfont">Edit a Video Group</h2>
        <form method="POST">

            <p>
                <input type= "radio" name = "edit_type" value="add_group" checked>
                <label for="add_group">Add a Group</label><br><br>

                <input type= "radio" name = "edit_type" value="delete_group" checked>
                <label for="delete_group">Delete a Group</label><br><br>

                <input type= "radio" name = "edit_type" value="edit_group_type" checked>
                <label for="edit_group_type">Change Group Type</label><br><br>

                 Current Group Type<br><br>
                <input type= "radio" name = "group_type" value="movie_group" checked>
                <label for="movie_group">Movie Group</label>

                <input type= "radio" name = "group_type" value="series_group" checked>
                <label for="series_group">Series Group</label><br><br>

                Group Title<br><input type="text" name="group_title" required><br><br>
             </p>

            <input type="submit" class="button button1" value="Submit"><br><br>
        </form>
    </div>
   <?$HTML->generateSiteEnd();