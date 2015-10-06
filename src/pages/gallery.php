<?php
    
    require_once $_SERVER["DOCUMENT_ROOT"]."ciconia/lib/lib.php";
    
    if(!isset($_SESSION))
    {
        session_start();
        return;
    }
    
    $path = $_SERVER["DOCUMENT_ROOT"]."ciconia/img/".$_SESSION["api"]."/";
    $images = scandir($path);
    
    array_shift($images);
    array_shift($images);
    
    echo(createThumbnailImage($path.$images[0]));
    
?>
