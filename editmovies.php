<?php
session_start();
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

$user_data = check_login();
$isAdmin = check_admin();
$MoviesEdit = edit_movies($_POST);
$HTML = new SiteGenerator("Edit Movies Page","background5");
$HTML->generateSiteStart();

?>

<div class="box" >

        <h2 id="redfont">Edit a Movie</h2>
        <form method="POST">

            <p>
                <input type= "radio" name = "edit_movies" value="add_movie" checked>
                <label for="add_movie">Add a Movie</label><br><br>
                <input type= "radio" name = "edit_movies" value="delete_movie" checked>
                <label for="add_season">Delete a Movie </label><br><br>
                <input type= "radio" name = "edit_movies" value="edit_description" checked>
                <label for="add_episode">Change Description</label><br><br>

                Title<br><input type="text" name="movie_title" required><br><br>
                Description<br><textarea class= "inputbox" input type="text" maxlength="200" name="movie_description"></textarea><br><br>
                Release Year<br><input id="releaseYear" type="number" min="1900" max ="2021" name="release" ><br><br>
                Reference Link<br><input type="text" name="thumbnail" ><br><br>
                Video Group<br><input type="text" name="movie_group" ><br><br>
                Embed Code<br><input type="text" name="movie_embed" ><br><br>
            </p>

            <input type="submit" class="button button1" value="Submit"><br><br>
        </form>
    </div>

<?php
require_once("includes/header.php");
require_once("includes/footer.php");
$HTML->generateSiteEnd();
?>
