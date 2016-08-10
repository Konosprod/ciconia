<?php

	require_once 'lib/DbManager.php';
	require_once 'lib/Utils.php';

	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_GET["logout"]))
	{
		$_SESSION["log"] = 0;
		header("Location: /");
		die();
	}
	else
	{
		$db = DbManager::getInstance();

		if(!is_null($db))
		{
			if(isset($_POST['pass']) and isset($_POST['user']))
			{
				$pw = $_POST['pass'];
				$user = $_POST['user'];

				$hash = Utils::getHash($pw, $user);

				$sql = "SELECT api_key FROM users where hash = :hash and user = :user";

				$stmt = $db->query($sql, array("hash"=>$hash, "user"=>$user));

				if((($row = $stmt->fetch(PDO::FETCH_ASSOC)) && $row))
				{
					$_SESSION['log'] = 1;
					$_SESSION["api"] = $row["api_key"];;
					header("Location: /gallery/");
					die();
				}
				else
				{
					header("Location: /error/index.php?e=1");
					die();
				}
			}
			else
			{
				echo("Error post");
			}
		}
		else
		{
			echo("Error connecting database");
		}
	}
?>

