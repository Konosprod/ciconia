<?php

    include("../lib/lib.php");
    
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    $db = getConnexion();
    
    if($db)
    {
        if(isset($_POST['pass']) and isset($_POST['user']))
        {
            $pw = $_POST['pass'];
            $user = $_POST['user'];
        
            $hash = getHash($pw, $user);
        
            $sql = "SELECT * FROM users where hash = :hash and user = :user";
        
            $stmt = $db->prepare($sql);
        
            if($stmt->execute(array("hash"=>$hash, "user" => $user)))
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                if($row)
                {
                    $_SESSION['log'] = 1;
                    header("Location: /");
                    die();
                }
            }
        }
        else
        {
            echo("Error");
        }
    }    
    else
    {
        echo("Error connecting database");    
    }
?>
