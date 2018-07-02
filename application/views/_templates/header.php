<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Job Portal</title>
    <script type="text/javascript" src="<?php echo URL; ?>public/script/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/script/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/script/script.js"></script>
    <link rel="stylesheet" href="<?php echo URL; ?>public/style/bootstrap.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/style/style.css">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="<?php echo URL; ?>public/img/Icon.jpg" class="img-rounded" href="../../index.php">
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../../assets/contact/contact.php">Contact US</a></li>
                    <li><a href="#">About US</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#menu4">Wellcome <?php if(isset($_SESSION['name'])){
                                                        $s = $_SESSION['name'];
                                                        echo $s; }?></a></li>
                    <li><a id="logout" href="<?php echo URL; ?>login/logout" >Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--Slide Show-->
    <div id="slideshow">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?php echo URL; ?>public/img/a.jpg" alt="...">
                    <div class="carousel-caption">
                        <h3>Find your Dream job</h3>
                        <p>Have a greate feuture</p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo URL; ?>public/img/b.jpg" alt="...">
                    <div class="carousel-caption">
                        <h3>Work what you love</h3>
                        <p>...</p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo URL; ?>public/img/c.jpg" alt="...">
                    <div class="carousel-caption">
                        <h3>Work on what you like</h3>
                        <p>...</p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>