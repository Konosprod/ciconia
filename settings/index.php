<?php
	require_once '../vendor/autoload.php';
	require_once '../lib/DbManager.php';

	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION["log"]) && $_SESSION["log"] == 0)
	{
		header("Location: ..");
		die();
	}

	$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
	$twig = new Twig_Environment($loader);

	$template = $twig->loadTemplate("settings.twig");

	$thumbs = array();

	$db = DbManager::getInstance();

	$stmt = $db->query($sql, array("api_key"=>$_SESSION["api"]));

	echo $template->render(array("api_key"=>$_SESSION["api"]));

?>
