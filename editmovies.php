<?php
include("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");
require_once("includes/header.php");
require_once("includes/footer.php");

session_start();

    $user_data = check_login($con);
    $isAdmin = check_admin($con);
    $MovieEdit = edit_movies($con);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Edit Movie</title>

<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="assets/css/style.css">


<body class="background5">


<div class="box" id='cent' style="margin-top:-30em;">

        <h2 id="redfont">Edit a Movie</h2>
        <form method="POST">

            <p>
                <input type= "radio" name = "edit_movies" value="add_movie" checked>
                <label for="add_movie">Add a Movie</label><br><br>
                <input type= "radio" name = "edit_movies" value="delete_movie" checked>
                <label for="add_season">Delete a Movie </label><br><br>
                <input type= "radio" name = "edit_movies" value="edit_description" checked>
                <label for="add_episode">Change Description</label><br><br>
            </p>

            <p>Title</p><input type="text" name="movie_title" required><br><br>
            <p>Description</p><textarea class= "inputbox" input type="text" maxlength="200" name="movie_description"></textarea><br><br>
            <p>Release Year</p><input id="releaseYear" type="number" min="1900" max ="2021" name="release" ><br><br>
            <p>Reference Link</p><input type="text" name="thumbnail" ><br><br>
            <p>Video Group</p><input type="text" name="movie_group" ><br><br>
            <p>Embed Code</p><input type="text" name="movie_embed" ><br><br>


            <input type="submit" class="button button1" value="Submit"><br><br>
        </form>
    </div>

</div>

</body>



</html>
