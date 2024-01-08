<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
    <?php
        include ('../admin/config.php');
        session_start();
		$_SESSION['message'] = '';
		
	include('../admin/queries.php');
	
	$name = mysqli_query($conn, $sitename);
	if (! $name) {
		die('Kon site naam niet inladen: '.mysqli_error($conn));
	}
	while($row = mysqli_fetch_assoc($name)) {?>
		<title>400 | <?php $site = htmlspecialchars($row['sitename']); echo $site ;?></title>
	<?php }
	?>
    <meta name="author" content="pkfrom" />
    <meta name="keywords" content="404 page, css3, template, html5 template" />
    <meta name="description" content="404 - Page Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Libs CSS -->
    <link type="text/css" media="all" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" media="all" href="./assets/css/404.min.css" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="./assets/img/favicons/favicon144x144.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="./assets/img/favicons/favicon114x114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="./assets/img/favicons/favicon72x72.png" />
    <link rel="apple-touch-icon" href="./assets/img/favicons/favicon57x57.png" />
    <link rel="shortcut icon" href="./assets/img/favicons/favicon.png" />
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

</head>
<body>

    <!-- Load page -->
    <div class="animationload">
        <div class="loader">
        </div>
    </div>
    <!-- End load page -->

    <!-- Content Wrapper -->
    <div id="wrapper">
        <div class="container">
            <!-- Switcher -->
            <div class="switcher">
                <input id="sw" type="checkbox" class="switcher-value">
                <label for="sw" class="sw_btn"></label>
                <div class="bg"></div>
                <div class="text">Turn <span class="text-l">off</span><span class="text-d">on</span><br />the light</div>
            </div>
            <!-- End Switcher -->

            <!-- Dark version -->
            <div id="dark" class="row text-center">
                <div class="info">
                    <img src="./assets/img/404-dark.png" alt="404 error" />
                </div>
            </div>
            <!-- End Dark version -->

            <!-- Light version -->
            <div id="light" class="row text-center">
                <!-- Info -->
                <div class="info">
                    <img src="./assets/img/404-light.gif" alt="404 error" />
                    <!-- end Rabbit -->
                    <p>System is currently under maintenance. For more info visit the <a href="http://status.jl-tech.be">Status Page</p>
                    <a href="http://%domain%/" class="btn">Go Home</a>
                    <!--<a href="#" class="btn btn-brown">Contact Us</a>-->
                </div>
                <!-- end Info -->
            </div>
            <!-- End Light version -->

        </div>
        <!-- end container -->
    </div>
    <!-- end Content Wrapper -->


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="//pkfrom.github.io/404/assets/js/modernizr.custom.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.0/jquery.nicescroll.min.js" type="text/javascript"></script>
    <script src="//pkfrom.github.io/404/assets/js/404.min.js" type="text/javascript"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</body>
</html>
