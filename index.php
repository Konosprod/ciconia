<?php
	require_once 'vendor/autoload.php';

	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_SESSION["log"]) && $_SESSION["log"] == 1)
	{
		header("Location: /gallery/");
		die();
	}

	$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
	$twig = new Twig_Environment($loader);

	$template = $twig->loadTemplate("login.twig");

	echo $template->render(array());

?>
