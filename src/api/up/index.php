<?php 

	require_once $_SERVER["DOCUMENT_ROOT"]."ciconia/lib/lib.php";

	if(isset($_GET["k"]) and isset($_GET["f"]))
	{
			if(apiKeyExist($_GET["k"]))
			{
                
			}
			else
			{
				echo("Api key doesn't exist");
			}
	}
	else
	{
		echo ("Missing arguments");
	}

?>