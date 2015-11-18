<?php
    
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    if($_SESSION['log'] == 0)
    {
        header("Location: ".$_SERVER['HTTP_REFERER']);
        die();
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link href="../includes/style/style.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div id="wrap">
            <?php
                $__ROOT__ = dirname(__FILE__)."/..";
                include($__ROOT__."/includes/navbar.html");
            ?>
            <div class="container">
                <div class="jumbotron">
                    <p>About Ciconia :</p>
                    I used to use Puush, developped by Peppy. It was a great software. But there was something that I didn't like. 
                    Where were my screens hosted ? Manage my personal information is important to me. Now, Ciconia allows everybody
                    who wants to host and manage their own screens with shorten urls.                  
                </div>
            </div>
	    </div>
    </body>
</html>
