<?php

    $__ROOT__ = dirname(__FILE__)."/..";
    
    require_once $__ROOT__."/lib/lib.php";
    
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    if(!isset($_GET["d"]))
    {
        header("Location: ..");
        die();
    }
    
    $db = getConnexion();
    
    if($db)
    {
        if(isUrlOwned($_GET["d"], $_SESSION["api"]))
        {
            deleteImage($_GET["d"]);
            header("Location: ..");
        }
        else
        {
            echo("Error");
        }
    }

?>
