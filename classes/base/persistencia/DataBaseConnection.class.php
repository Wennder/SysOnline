<?php

abstract class DatabaseConnection
{
	protected $host;
	protected $user;
	protected $password;
	protected $port;
	protected $dbname;
	
	protected $conn = null;
	
	function __destruct()
	{
		$this->closeConn();
	}
		
	final protected function isConnected()
	{
		return ($this->conn !== null);
	}
	
	public static function keyDriver()
	{
	}
	
	abstract public function beginTrans();
	
	abstract public function commitTrans();
	
	abstract public function rollBackTrans();
	
	abstract public function connect();
	
	abstract public function closeConn();
	
	abstract public function query($sql);
	
	abstract public function lastInsertId();
}

abstract class DataBaseResult
{
	const FETCH_NUM = 0;
	const FETCH_ASSOC = 1;
	
	private $fetchOption = self::FETCH_ASSOC;
	protected $conn;
	protected $resultQuery;
	
	public function __construct($dbConn, $resultQuery)
	{
		$this->conn = $dbConn;
		$this->resultQuery = $resultQuery;
	}
	
	final protected function setFecthOption($op)
	{
		switch ( $op)
		{
			case self::FETCH_NUM :
				$this->fetchOption = self::FETCH_NUM;
				break;
			
			case self::FETCH_ASSOC :
				$this->fetchOption = self::FETCH_ASSOC;
				break;
			
			default :
				$this->fetchOption = self::FETCH_ASSOC;
				break;
		}
	}
	
	final protected function getFetchOption()
	{
		return $this->fetchOption;
	}
	
	final public function checkRowCount()
	{
		if ($this->rowCount() <= 0)
		{
			return FALSE;
		} else
		{
			return TRUE;
		}
	}
	
	abstract public function rowCount();
	
	abstract public function getOneResult();
	
	abstract public function getAllResult();
	
	abstract public function closeResult();
}

?>