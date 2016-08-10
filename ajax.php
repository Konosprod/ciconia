<?php
        require_once 'vendor/autoload.php';
	require_once 'lib/Utils.php';

	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION["log"]) || $_SESSION["log"] == 0)
	{
		header("Location: /");
		die();
	}

	if(isset($_POST['toDelete']))
	{
		$toDelete = $_POST['toDelete'];

		foreach($toDelete as $img)
		{
			if(Utils::isUrlOwned($img, $_SESSION['api']))
			{
				Utils::deleteImage($img);
			}
		}

		$min = $_POST["page"];

		$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
		$twig = new Twig_Environment($loader);

		$thumbs = array();

		$db = DbManager::getInstance();

		$stmt = $db->query("select count(*) from push where api_key = :api_key", array("api_key"=>$_SESSION["api"]));

		$pages = (int)($stmt->fetchColumn()/18);

		$sql = "SELECT url, shorten FROM push where api_key = :api_key limit 18 offset ".$min*18;

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

		$template = $twig->loadTemplate("thumbs.twig");

        	die(json_encode(array("ret"=>$template->render(array("thumbs"=>$thumbs, "max"=>$pages, "active"=>$min)))));
	}
?>
