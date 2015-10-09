<?php
    
    require_once $_SERVER["DOCUMENT_ROOT"]."/ciconia/lib/lib.php";

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
                
                $filename = $_SERVER["DOCUMENT_ROOT"]."/ciconia/".$url;
                
                $fp = fopen($filename, 'rb');
              
                header("Content-Type: ".getMimeType($filename));
                header("Content-Length: ".filesize($filename));
                header('Content-Disposition: inline; filename="'.basename($filename).'"');
                
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
