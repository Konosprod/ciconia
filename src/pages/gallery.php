<?php

    $__ROOT__ = dirname(__FILE__)."/..";
    
    require_once $__ROOT__."/lib/lib.php";
    
    if(!isset($_SESSION))
    {
        session_start();
        return;
    }
    
    $path = $__ROOT__."/img/".$_SESSION["api"]."/";
    $images = scandir($path);
    
    array_shift($images);
    array_shift($images);
    
    foreach($images as $img)
    {
        if($img != "thumbs")
        {
            $short = getShortUrl('img/'.$_SESSION["api"]."/".$img);
            echo('<a href="/'.$short.'"><img src="img/'.$_SESSION["api"]."/thumbs/".$img.'">'.'</a>');
        }
    }
?>

<a href="pages/login.php?logout=1">Logout</a>
