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

	$min = 0;

	if(isset($_GET["page"]))
	{
		if(is_numeric($_GET["page"]))
		{
			$min = $_GET["page"];
		}
	}

	$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
	$twig = new Twig_Environment($loader);

	$template = $twig->loadTemplate("gallery.twig");

	$thumbs = array();

	$db = DbManager::getInstance();

	$stmt = $db->query("SELECT COUNT(*) FROM push WHERE api_key = :api_key", array("api_key"=>$_SESSION["api"]));

	$pages = (int)($stmt->fetchColumn()/18);

	$sql = "SELECT url, shorten FROM push WHERE api_key = :api_key limit 18 offset ".$min*18;

	$stmt = $db->query($sql, array("api_key"=>$_SESSION["api"]));

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach($rows as $row)
	{
		$base = basename($row["url"]);
		$dir = dirname($row["url"]);

		$thumb = array();
		$thumb["url"] = "/".$row["shorten"];
		$thumb["src"] = "../".$dir."/thumbs/".$base;
		$thumb["val"] = $row["shorten"];
		$thumbs[] = $thumb;
	}

	echo $template->render(array("thumbs"=>$thumbs, "max"=>$pages, "active"=>$min));

?>
