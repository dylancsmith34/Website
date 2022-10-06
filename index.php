<!DOCTYPE html>
<html>

<!------------ Head, used to reference stylesheets, set the title, characterset, viewport, and to include config ------------>

<head>
    <title>Merlot and a Masterpiece</title>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div><?php require('header.php');?></div>
    <center>
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="images/carousel1.png" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="images/carousel2.png" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="images/carousel3.png" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="images/carousel4.png" style="width:100%;">

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span><span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div style="margin: 10px;">
            <h2>We are back in studio! In addition, we are still offering virtual classes and take home kits. Visit our calendar for more details. </h2>
            <br>
            <h4>We are a BYOB(bring your own beverage) environment</h4>
            <br>
            <br>
        </div>
    </center>

    <div><?php require('footer.php');?></div>
</body>

</html>

</html>
