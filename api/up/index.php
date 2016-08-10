<?php
	require_once '../../lib/Utils.php';
	$__ROOT__ = dirname(__FILE__)."/../..";

	if(isset($_POST["k"]))
	{
		if(Utils::apiKeyExist($_POST["k"]))
		{
			$filename = Utils::cleanString(basename($_FILES["img"]["name"]));
			$outpath = $__ROOT__."/img/".$_POST["k"]."/";

			if(!file_exists($outpath.$filename))
			{
				if(filesize($_FILES["img"]["tmp_name"]) < __MAX_SIZE__)
				{
					if(move_uploaded_file($_FILES["img"]["tmp_name"], $outpath.$filename))
					{
						echo(Utils::createThumbnail($outpath, $filename));
						echo(Utils::createShortLink("img/".$_POST["k"]."/".$filename, $_POST['k']));
					}
					else
					{
						echo("-1\n");
					}
				}
				else
				{
					echo("-4\n");
				}
			}
			else
			{
				echo("-2\n");
			}
		}
		else
		{
			echo("-5\n");
		}
	}
	else
	{
		echo("-3\n");
	}

?>
