<?php

	function deleteImg($shorten, $api_key)
	{
		if(isUrlOwned($shorten, $api_key))
		{
            deleteImage($shorten);
        }
        else
        {
            echo("Error");
        } 
    }

    $__ROOT__ = dirname(__FILE__)."/..";
    
    require_once $__ROOT__."/lib/lib.php";
    
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    if(!isset($_GET["d"]) && !isset($_GET["dm"]))
    {
        header("Location: ..");
        die();
    }
    
    $db = getConnexion();
    
    if($db)
    {
        if(isset($_GET["d"]))
        {
            deleteImg($_GET["d"], $_SESSION["api"]);
        }
        else
        {
            $images = json_decode($_GET["dm"]);
            
            foreach($images as $img)
            {
                deleteImg($img, $_SESSION["api"]);
            }
        }
        
        header("Location: ..");
        die();
    }
?>
