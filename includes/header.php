<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ISCREAM</title>
    <link rel="stylesheet" href="../assets/css/style.css">


</head>

<body>
     <header>
                <div class="headerobj left">

                    <div id="logo">
                        <a href="index.php">
                        <img class ="headerlogo" src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png"></img></a>
                    </div>
                </div>

                <div class="hovermenu">
                    <div class="headerobj left">
                    <a href="movies.php?site=movies" class="button2" style="text-decoration: none">Filme</a>
                    </div>
                        <div class="dropcont">
                            <table>
                                <tr><td><p><a href="movies.php">Zombie</p></a></td></tr>
                                <tr><td><p><a href="movies.php">Psycho</p></td></tr>
                                <tr><td><p><a href="movies.php">Gore</p></td></tr>
                                <tr><td><p><a href="movies.php">Haunted</p></td></tr>
                            </table>
                        </div>
                    </div>


                <div class="hovermenu">
                    <div class="headerobj left">
                        <a href="movies.php?site=series" class="button2" style="text-decoration: none">Serien</a>
                        </div>
                        <div class="dropcont">
                            <table>
                                <tr><td><p><a href="series.php">Zombie</p></a></td></tr>
                                <tr><td><p><a href="series.php">Haunted</p></td></tr>
                                <tr><td><p><a href="series.php">Psycho</p></td></tr>
                                <tr><td><p><a href="series.php">Gore</p></td></tr>
                            </table>
                        </div>
                    </div>



                <div class="headerobj mid">

                </div>

                <div class="headerobj right">
                    <a href="watchlist.php" class="button2" style="text-decoration: none">Watchlist</a>
                </div>

                <div class="headerobj right">
                    <a href="account-management.php" class="button2" style="text-decoration: none">Account</a>
                </div>


                <div class="headerobj right">
                <a href="login.php" class="button2" style="text-decoration: none">Logout</a>
                </div>
            </div>
    </header>

 <!-- <script>
   // When the user scrolls the page, execute myFunction
   window.onscroll = function() {myFunction()};

   // Get the header
   var header = document.getElementsByClassName(header);

   // Get the offset position of the navbar
   var sticky = header.offsetTop;

   // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
   function myFunction() {
       if (window.pageYOffset > sticky) {
           header.classList.add("sticky");
       } else {
           header.classList.remove("sticky");
       }
   }
  </script>
-->
</body>

</html>
