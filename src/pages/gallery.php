<?php
    
    require_once $_SERVER["DOCUMENT_ROOT"]."/ciconia/lib/lib.php";
    
    if(!isset($_SESSION))
    {
        session_start();
        return;
    }
    
    $path = $_SERVER["DOCUMENT_ROOT"]."/ciconia/img/".$_SESSION["api"]."/";
    $images = scandir($path);
    
    array_shift($images);
    array_shift($images);
    
    foreach($images as $img)
    {
        if($img != "thumbs")
        {
            echo '<img src="img/'.$_SESSION["api"]."/thumbs/".$img.'"><br/>';
        }
    }
?>

<a href="pages/login.php?logout=1">Logout</a>
