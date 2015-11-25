<?php

    $__ROOT__ = dirname(__FILE__)."/..";
    
    require_once $__ROOT__."/lib/lib.php";
    
    if(!isset($_SESSION))
    {
        session_start();
        return;
    }

   include($__ROOT__."/includes/navbar.html");
    
    $path = $__ROOT__."/img/".$_SESSION["api"]."/";
    
    try
    {
        $db = getConnexion();
        
        $sql = "SELECT COUNT(id) AS rows FROM push WHERE api_key = '".$_SESSION["api"]."'";
        $total = $db->query($sql)->fetch(PDO::FETCH_OBJ)->rows;
        
        $perpage = 40;
        $pages = ceil($total/$perpage);
        
        $get_pages = isset($_GET['page']) ? $_GET['page'] : 1;
        
        $data = array(
            'options' => array(
                'default' => 1,
                'min_range' => 1,
                'max_rage' => $pages
            )
        );
        
        $number = trim($get_pages);
        $number = filter_var($number, FILTER_VALIDATE_INT, $data);
        $range = $perpage * ($number - 1);
        
        $prev = $number - 1;
        $next = $number + 1;
        
        $sql = 'SELECT url, shorten FROM push where api_key = :api_key LIMIT :limit, :perpage';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':api_key', $_SESSION["api"], PDO::PARAM_STR);
        $stmt->bindParam(':perpage', $perpage, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $range, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $result = $stmt->fetchAll(); 
    }
    catch(PDOException $e)
    {
        echo($e);
    }
    
    echo('<div class="row">'); 
    foreach($result as $entry)
    {
        $base = basename($entry['url']);
        $dir = dirname($entry['url']);
        echo('<div class="col-xs-1 col-sm-1">');
        echo('<div class="thumbnail" style="text-align:center"><a href="/'.$entry['shorten'].'"><img src="'.$dir.'/thumbs/'.$base.'"></a><a href="pages/delete.php?d='.$entry['shorten'].'">Delete</a><input type="checkbox" style="visibility:hidden" name="todelete" value="'.$entry["shorten"].'"></div>');
        echo('</div>');
    }
    echo("</div>");
    echo('<div class="row">');
    echo('<div class="text-center">');
    echo('<ul class="pagination sticky-pagination">');
    
    if($result && count($result) > 0)
    {
        if($number <= 1 && $pages <= 1)
        {
            echo('<li class="disabled"><a href="#">prev</a></li><li class="disabled"><a href="#">next</a></li>');
        }
        elseif($number <= 1)
        {
            echo('<li class="disabled"><a href="#">prev</a></li><li><a href=\"?page=$next\">next</a></li>');
        }
        elseif($number >= $pages)
        {
            echo ('<li><a href=\"?page=$prev\">prev</a></li><li class="disabled"><a href="#">next</a></li>'); 
        }
        else
        {
            echo ('<li><a href=\"?page=$prev\">prev</a></li><li><a href=\"?page=$next\">next</a></li>');
        }
    }
    
    echo("</ul>");
    echo("</div>");
    echo("</div>");
?>


