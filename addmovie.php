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
<html lang="en">
<meta charset="UTF-8">
<title>Add Movie</title>

<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="assets/css/style.css">


<body class="background5">

<a href='addseries.php' class='button button1' style='width:100px; margin-top:20px;'>Add Series</a>

<div class="box" id='cent'>

        <h2 id="redfont">Add a Series</h2>
        <form method="POST">

            <input type="file" name="movie_image" accept ="image/*"id="file" onchange ="loadFile(event)" style="display:none;" required><br><br>
            <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
            <p><img id="output" width="200" /></p>

            <p>Movie Title</p><input type="text" name="movie_title" required><br><br>
            <p>Reference Link</p><input type="text" name="movie_link" required><br><br>
            <p>Video Group</p><input type="text" name="movie_group" required><br><br>


            <input type="submit" class="button button1" value="Submit"><br><br>
        </form>
    </div>


</div>

</body>
<script>

var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
</html>
