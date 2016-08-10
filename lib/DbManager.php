<?php

$__ROOT__ = dirname(__FILE__).'/..';

require_once $__ROOT__.'/config.php';

class DbManager {

	private static $instance = null;
	private $pdoInstance = null;

	private $sqlHost = __DB_HOST__;
	private $sqlUser = __DB_USER__;
	private $sqlPass = __DB_PASS__;
	private $sqlDb = __DB_NAME__;

	private function __construct()
	{
		$this->pdoInstance = new PDO('mysql:dbname='.$this->sqlDb.';host='.$this->sqlHost.';charset=utf8', $this->sqlUser, $this->sqlPass);
	}

	public static function getInstance()
	{
		if(is_null(self::$instance))
		{
			self::$instance = new DbManager();
		}
		return self::$instance;
	}

	public function query($query, $params)
	{
		$stmt = $this->pdoInstance->prepare($query);

		$stmt->execute($params);

		return $stmt;
	}
}

?>
