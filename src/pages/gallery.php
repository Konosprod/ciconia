<?php
    
    define("__ROOT_PATH", dirname(__DIR__));
    define("__ROOT__", dirname(__ROOT_PATH));
    
    include(__ROOT__."/lib/lib.php");
    
    if(!isset($_SESSION))
    {
        session_start();
    }

    echo("Gallery");
    
    $_SESSION['log'] = 0;
    
?>
