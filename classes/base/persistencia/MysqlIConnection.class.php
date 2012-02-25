<?php
require_once 'classes/base/persistencia/DataBaseConnection.class.php';

class MysqlIConnection extends DatabaseConnection
{
	function __construct($params = false)
	{
		$this->host = $params ['host'];
		$this->user = $params ['user'];
		$this->password = $params ['password'];
		$this->port = $params ['port'];
		$this->dbname = $params ['dbname'];
	}
	
	private function autoCommitON()
	{
		if (!$this->conn->autocommit(true))
		{
			throw new Exception("Nao foi possível iniciar a transação: " . mysqli_connect_error());
		}
	}
	
	private function autoCommitOFF()
	{
		if (!$this->conn->autocommit(false))
		{
			throw new Exception("Nao foi possível iniciar a transação: " . mysqli_connect_error());
		}
	}
	
	public static function keyDriver()
	{
		return "mysqli";
	}
	
	function beginTrans()
	{
		if (!$this->isConnected())
		{
			$this->connect();
		}
		
		$this->autoCommitOFF();
	}
	
	function commitTrans()
	{
		if (!$this->conn->commit())
		{
			throw new Exception("Nao foi possível fazer o commit da transação: " . mysqli_connect_error());
		}
		
		$this->autoCommitON();
	}
	
	function rollBackTrans()
	{
		if (!$this->conn->rollback())
		{
			throw new Exception("Nao foi poss�vel fazer o rollback da transa��o: " . mysqli_connect_error());
		}
		
		$this->autoCommitON();
	}
	
	function connect()
	{
		$this->conn = @mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
		
		if (!$this->conn)
		{
			throw new Exception("Erro ao conectar no servidor de banco de dados: " . mysqli_connect_error());
		}
	}
	
	function closeConn()
	{
		if ($this->conn)
		{
			$this->conn->close();
			$this->conn = null;
		}
	}
	
	function query($sql)
	{
		if (!$this->isConnected())
		{
			$this->connect();
		}
		
		$resultQuery = $this->conn->query($sql);
		
		if (!$resultQuery)
		{
			throw new Exception("Falha ao tenta executar esta query: " . mysqli_error($this->conn) . "({$sql})");
		}
		
		$dbResult = new MysqlIResult($this, $resultQuery);
		return $dbResult;
	}
	
	public function lastInsertId()
	{
		return $this->conn->insert_id;
	}
}

class MysqlIResult extends DataBaseResult
{
	public function rowCount()
	{
		return $this->resultQuery->num_rows;
	}
	
	public function getOneResult()
	{
		if (!parent::checkRowCount())
		{
			return NULL;
		}
		
		switch ( $this->getFetchOption())
		{
			case self::FETCH_NUM :
				$result = $this->resultQuery->fetch_row();
			
			break;
			
			case self::FETCH_ASSOC :
				$result = $this->resultQuery->fetch_assoc();
			
			break;
			
			default :
				$result = $this->resultQuery->fetch_assoc();
			
			break;
		}
		
		$this->closeResult();
		
		return $result;
	}
	
	public function getAllResult()
	{
		if (!parent::checkRowCount())
		{
			return NULL;
		}
		
		switch ( $this->getFetchOption())
		{
			case self::FETCH_NUM :
				$funcao = "fetch_row";
			
			break;
			
			case self::FETCH_ASSOC :
				$funcao = "fetch_assoc";
			
			break;
			
			default :
				$funcao = "fetch_assoc";
			
			break;
		}
		
		while ( $tmp = $this->resultQuery->$funcao() )
		{
			$result [] = $tmp;
		}
		
		$this->closeResult();
		
		return $result;
	}
	
	function closeResult()
	{
		if ($this->resultQuery)
		{
			$this->conn = null;
			$this->resultQuery->free();
			$this->resultQuery = null;
		}
	}
}

?>