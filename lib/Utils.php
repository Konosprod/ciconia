<?php

$__ROOT__ = dirname(__FILE__).'/..';

require_once $__ROOT__.'/config.php';
require_once 'DbManager.php';

class Utils {

	public static function getHash($pass, $user)
	{
		$user_salt = md5($pass.$user);
		$combine = $pass.$user_salt.__SITEKEY__;

		return hash('sha512', $combine);
	}

	public static function createThumbnail($path, $img)
	{
		$query = "convert ".$path.$img." -resize 80x80 -background white -gravity center -extent 80x80 ".$path."thumbs/".$img;
		exec($query, $string);
	}

	public static function apiKeyExist($key)
	{
		$db = DbManager::getInstance();

		$sql = "SELECT id FROM users WHERE api_key = :api_key";

		$stmt = $db->query($sql, array("api_key"=>$key));

		return ($stmt->fetch(PDO::FETCH_ASSOC) != false);
	}

	public static function getApiKey($pw, $user)
	{
		$hash = Utils::getHash($pw, $user);
		$api_key = md5($hash);

		return strtoupper($api_key);
	}

	public static function getRandomName()
	{
		$id = rand(10000, 99999);
		$shortUrl = base_convert($id, 20, 36);

		return $shortUrl;
	}

	public static function urlExist($url)
	{
		$db = DbManager::getInstance();

		$sql = "select url from push where url = :url";

		$stmt = $db->query($sql, array("url"=>$url));

		return ($stmt->fetch(PDO::FETCH_ASSOC) != false);
	}

	public static function cleanString($string)
	{
		$string = str_replace(' ', '-', $string);
		return preg_replace('/[^A-Za-z0-9\-.]/', '_', $string);
	}

	public static function getMimetype($path)
	{
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $path);

		finfo_close($finfo);

		return $mime;
	}

	public static function endsWith($haystack, $needle)
	{
		$length = strlen($needle);

		if($length == 0)
		{
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}

	private function insertUrl($url, $api_key)
	{
		$short = Utils::getRandomName();

		$db = DbManager::getInstance();

		$sql = "insert into push (url, shorten, api_key) values(:url, :shorten, :api_key)";

		$stmt = $db->query($sql, array("url"=>$url, "shorten"=>$short, "api_key"=>$api_key));

		return $short;
	}

	public static function createShortLink($url, $api_key)
	{
		$shorturl = "";

		if(!self::urlExist($url))
		{
			$shorturl = self::insertUrl($url, $api_key);
			return __BASE_PATH__."/".$shorturl;
		}
		else
		{
			return null;
		}
	}

	public static function deleteImage($shorten)
	{
		$__ROOT__ = dirname(__FILE__)."/..";

		$db = DbManager::getInstance();

		$sql = "select url from push where shorten = :shorten";

		$stmt = $db->query($sql, array("shorten" => $shorten));

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($row)
		{
			$url = $row["url"];

			$base = basename($url);
			$dir = dirname($url);

			if(!unlink($__ROOT__."/".$url) && !unlink($__ROOT__."/".$dir."/thumbs/".$base))
			{
				echo("Error");
			}

			$sql = "delete from push where shorten = :shorten";

			$db->query($sql, array("shorten"=>$shorten));
		}
	}

	public static function isUrlOwned($shorten, $api)
	{
		$db = DbManager::getInstance();

		$sql = "select * from push where shorten = :shorten and api_key = :api_key";

		$stmt = $db->query($sql, array("shorten"=>$shorten, "api_key"=>$api));

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return ($row != false);
	}
}

?>
