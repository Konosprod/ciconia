<?php

    require_once $_SERVER["DOCUMENT_ROOT"]."ciconia/lib/lib.php";    

	try
	{
		$db = createConnexion();
	}
	catch(PDOException $e)
	{
		echo($e);
	}
	
	if($db)
	{
	    if(isset($_POST['url']))
	    {
	        if(!urlExist($db, $_POST['url']))
	        {
	            insertUrl($db, $_POST['url']);
	        }
	    }
	    else
	    {
	        echo("Error");
	    }
	}
	else
	{
		echo("Erreur !");
	}

	echo("Shorturl : ".$_SERVER["SERVER_NAME"]."/".$shorturl);

?>
