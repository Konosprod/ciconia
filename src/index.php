<?php
    
    include("config.php");
    
    $__ROOT__ = dirname(__FILE__);
    
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    if(!isset($_SESSION['log']))
    {
        $_SESSION['log'] = 0;
    }
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="includes/style/style.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
    <?php
    
	    if($_SESSION['log'] == 0)
        {
            include($__ROOT__."/includes/login.html");
	    }
	    else
	    {
	        include($__ROOT__."/pages/gallery.php");
	    }
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<footer class="footer">
        <p class="text-muted credit">About : <a href="#">About</a></p>
    </footer>

    </body>
</html>
