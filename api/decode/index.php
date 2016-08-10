<?php

	require_once '../../lib/Utils.php';
	require_once '../../lib/DbManager.php';
	$__ROOT__ = dirname(__FILE__)."/../..";

	$sql = "SELECT url FROM push WHERE shorten = :shorten";

	if(isset($_GET['decode']))
	{
		$db = DbManager::getInstance();

		$stmt = $db->query($sql, array("shorten"=>$_GET['decode']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$row)
		{
			echo("Shorten url doesn't exist");
		}
		else
		{
			$url = $row['url'];

			$filename = $__ROOT__."/".$url;

			$fp = fopen($filename, 'rb');

			header("Content-Type: ".Utils::getMimeType($filename));
			header("Content-Length: ".filesize($filename));
			header('Content-Disposition: inline; filename="'.basename($filename).'"');

			fpassthru($fp);
			fclose($fp);
			die();
		}
	}
	else
	{
		echo("Error");
	}
?>
