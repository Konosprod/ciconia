<?php
	$__ROOT__ = dirname(__FILE__)."/..";

	require_once $__ROOT__."/lib/lib.php";

	if(!isset($_SESSION))
	{
		session_start();
	}

	$db = getConnexion();

	$sql = "SELECT user FROM users WHERE api_key = :api_key";

	$stmt = $db->prepare($sql);

	if($stmt->execute(array("api_key" => $_SESSION["api"])))
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($row)
		{
			$hash = getHash($_POST["pass"], $row["user"]);
			$api = getApiKey($_POST["pass"], $row["user"]);

			$sql = "REPLACE INTO users(user, hash, api_key) VALUES(:user, :hash, :api)";

			$stmt = $db->prepare($sql);

			$stmt->execute(array("user" => $row["user"], "hash" => $hash, "api" => $api));
			$_SESSION["api"] = $api;
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
	}

?>
