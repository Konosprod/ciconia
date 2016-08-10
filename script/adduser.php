#!/usr/bin/env php
<?php
	//Function to read password, if stars = false
	//nothing will be written on STDIN
	//else, stars will be printed
	function getPassword($stars = false)
	{
		// Get current style
		$oldStyle = shell_exec('stty -g');

		if ($stars === false) {
			shell_exec('stty -echo');
			$password = rtrim(fgets(STDIN), "\n");
		} else {
			shell_exec('stty -icanon -echo min 1 time 0');

			$password = '';
			while (true) {
				$char = fgetc(STDIN);

				if ($char === "\n") {
					break;
				} else if (ord($char) === 127) {
					if (strlen($password) > 0) {
						fwrite(STDOUT, "\x08 \x08");
						$password = substr($password, 0, -1);
					}
				} else {
					fwrite(STDOUT, "*");
					$password .= $char;
				}
			}
		}

		// Reset old style
		shell_exec('stty ' . $oldStyle);

		// Return the password
		return $password;
	}

	$__ROOT__ = dirname(__FILE__)."/..";

	require_once $__ROOT__."/lib/Utils.php";
	require_once $__ROOT__."/lib/DbManager.php";

	echo("Username : ");
	$username = trim(fgets(STDIN));

	echo("User password : ");
	$upass = getPassword(true);

	$hash = Utils::getHash($upass, $username);
	$api = Utils::getApiKey($upass, $username);

	$db = DbManager::getInstance();

	$sql = "insert into users(user, hash, api_key) values(:user, :hash, :api)";

	$stmt = $db->query($sql, array("user"=>$username, "hash"=>$hash, "api"=>$api));

	echo("\nCreating directories...\n");

	if(!file_exists($__ROOT__."/img/".$api."/thumbs/"))
	{
		mkdir($__ROOT__."/img/".$api."/thumbs/", 0777, true);
	}

	echo("User created !\n");

?>
