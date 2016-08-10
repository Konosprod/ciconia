<?php
	require_once '../vendor/autoload.php';
	require_once '../lib/DbManager.php';

	$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
	$twig = new Twig_Environment($loader);

	$template = $twig->loadTemplate("error.twig");

	$msg = "Unknown error";

	$req = $_GET["e"];

	if(is_numeric($req))
	{
		switch($req)
		{
			case 1:
				$msg = "Error while loging in. Please verify your password and your username.";
			break;

			default:
				$msg = "An error has occured.";
			break;
		}
	}



	echo $template->render(array("msg"=>$msg));
?>
