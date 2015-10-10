<?php 

    $__ROOT__ = dirname(__FILE__)."/../..";
	require_once $__ROOT__."/lib/lib.php";

	if(isset($_POST["k"]))
	{
	    if(apiKeyExist($_POST["k"]))
		{
		    $filename = cleanString(basename($_FILES["img"]["name"]));
		    $outpath = $__ROOT__."/img/".$_POST["k"]."/";
		    
		    if(!file_exists($outpath.$filename))
		    {
		        if(filesize($_FILES["img"]["tmp_name"]) < __MAX_SIZE__)
		        {
		            if(move_uploaded_file($_FILES["img"]["tmp_name"], $outpath.$filename))
                    {
                        createThumbnail($outpath, $filename);
                        echo(createShortLink("img/".$_POST["k"]."/".$filename, $_POST['k']));
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
