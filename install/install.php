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

	//Reset configuration
	$file = fopen($__ROOT__."/config.php", "w");
	$str = "<?php ?>";
	fwrite($file, $str);
	fclose($file);

	require_once $__ROOT__."/lib/Utils.php";
	require_once $__ROOT__."/lib/DbManager.php";

	echo("Database host : ");
	$host = trim(fgets(STDIN));

	echo("Database name : ");
	$name = trim(fgets(STDIN));

	echo("Database user : ");
	$user = trim(fgets(STDIN));

	echo("Database password : ");
	$pass = getPassword(true);

	echo("\nBase url (example : http://ciconia.com) : ");

	$base = trim(fgets(STDIN));

	//Write configuration
	$file = fopen($__ROOT__."/config.php", "w");

	$str = "<?php\n".
	"\tdefine(\"__ROOT__\", getcwd());\n".
	"\tdefine(\"__SITEKEY__\",".time().");\n".
	"\tdefine(\"__DB_NAME__\",\"".$name."\");\n".
	"\tdefine(\"__DB_HOST__\",\"".$host."\");\n".
	"\tdefine(\"__DB_USER__\",\"".$user."\");\n".
	"\tdefine(\"__DB_PASS__\",\"".$pass."\");\n".
	"\tdefine(\"__MAX_SIZE__\", 100000000);\n".
	"\tdefine(\"__BASE_PATH__\",\"".$base."\");\n".
	"?>";

	fwrite($file, $str);

	fclose($file);

	//Load .sql file
	exec("mysql --user=".$user." --password=".$pass." --host=".$host." -D ".$name." < database.sql");

	echo("We are now creating the first user. You can add more user using the adduser.php script in the script directory\n");

	echo("Username : ");
	$username = trim(fgets(STDIN));

	echo("User password : ");
	$upass = getPassword(true);

	include($__ROOT__."/config.php");

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

	echo("Done. You can now use ciconia perfectly\n");
?>
