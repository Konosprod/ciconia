#!/usr/bin/env php

<?php
	function delete_files($target) {
		if(is_dir($target)){
			$files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
			foreach( $files as $file )
			{
				delete_files( $file );
			}
			rmdir( $target );
		} elseif(is_file($target)) {
			unlink( $target );
		}
	}

	$__ROOT__ = dirname(__FILE__)."/..";

	require_once $__ROOT__."/lib/Utils.php";
	require_once $__ROOT__."/lib/DbManager.php";

	echo("Username to delete : ");
	$name = trim(fgets(STDIN));

	$sql = "select api_key where user = :name";

	$db = DbManager::getInstance();

	$stmt = $db->query($sql, array("name"=>$name));

	$api = $stmt->fetch(PDO::FETCH_ASSOC)["api_key"];

	if($api != "")
	{
		$sql = "delete from users where user = :name";

		$db->query($sql, array("name"=>$name));

		delete_files($__ROOT__."/img/".$api);
	}
	else
	{
		echo("User not found. Exit.");
	}

?>
