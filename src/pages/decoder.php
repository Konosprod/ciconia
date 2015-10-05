<?php
    
    include(__ROOT__."/lib/lib.php");

    try
    {
        $db = getConnexion();
    }
    catch(PDOException $e)
    {
        echo($e);
    }
    
    $sql = "SELECT url FROM push WHERE shorten = :shorten";
    
    $stmt = $db->prepare($sql);
    
    if(isset($_GET['decode']))
    {
        if($stmt->execute(array('shorten' => $_GET['decode'])))
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if(!$row)
            {
                echo("Shorten url doesn't exist");
            }
            else
            {
                $url = $row['url'];
                
                $filename = substr($url, 4);
                $fp = fopen($url, 'rb');
                
                header("Content-Type: ".getMimeType($url));
                header("Content-Length: ".filesize($url));
                header('Content-Disposition: inline; filename="'.$filename.'"');
                
                fpassthru($fp);
                
                fclose($fp);
                
                die();
            }
        }
    }
    else
    {
        echo("Error");
    }
?>
