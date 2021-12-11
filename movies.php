<?php
require_once("includes/header.php");
require_once("includes/footer.php");
include("connection.php");
include("functions.php");

session_start();

    $user_data = check_login($con);
?>

<html lang="de">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/css/js/script.js"></script>

  </head>
  
  <body class="background3">
    <h3 id="whitefont" style="margin:5px;" >Zombie</h3> 

    <div class="videowrapper">
      <div ><img class= "videobox"src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div> 
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox"src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
    </div>

    <h3 id="whitefont" style="margin:5px;">Haunted</h3>

    <div class="videowrapper">
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox"src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div> 
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox"src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
    </div>

    <h3 id="whitefont" style="margin:5px;">Psycho</h3>

    <div class="videowrapper">
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div> 
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox"src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div> 
      <div ><img class= "videobox" src="https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg"></div>
    </div>
     

  </body>
</html>