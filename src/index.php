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
</html>
