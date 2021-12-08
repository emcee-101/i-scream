<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ISCREAM</title>
    <link rel="stylesheet" href="../assets/css/style.css">

     <style>



    .headerwrap {
        height: 80px;

        display: flex;
        flex-direction: row;
        background-color: #f1f1f1;
        align-items:flex-start;
    }

    .headerobj{
        margin: 20px;

    }

    .headerobj.mid{
        width:100%;
        overflow: hidden;
    }

    .hovermenu{

        position: relative;
        display: inline-block;
        }

    .dropcont{
        display: none;


    }
    .hovermenu:hover .dropcont {
        display: block;


    </style>


</head>

<body>
     <header>
        <div class="headerwrap">
                <div class="headerobj left">

                    <div id="logo">
                        <a href="/index.php">
                        <img src="https://image.spreadshirtmedia.net/image-server/v1/mp/designs/170504311,width=178,height=178/totenkopf-eis-in-der-waffel.png" height=40px width=40px></img></a>
                    </div>
                </div>

                <div class="hovermenu">
                    <div class="headerobj left">
                        Filme
                    </div>
                    <div class="dropcont">
                            <table>
                                <tr><td>Zombie</td></tr>
                                <tr><td>Haunted</td></tr>
                            </table>
                        </div>
                    </div>


                <div class="hovermenu">
                        <div class="headerobj left">
                                Serien
                            </div>
                        <div class="dropcont">
                            <table>
                                <tr><td>hello</td></tr>
                                <tr><td>hello2</td></tr>
                            </table>
                        </div>
                    </div>

                <div class="headerobj mid">

                </div>

                <div class="headerobj right">
                    Account
                </div>


                <div class="headerobj right">
                    Logout
                </div>
            </div>
        </div>
    </header>

</body>

</html>
