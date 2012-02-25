<?php
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';

class DBUtil
{
	public static function getMap($table, $key, $value, $condition = null)
	{
		$dbConn = DatabaseConnectionFactory::getDefaultConnection ();
		
		if (! empty ( $condition ))
		{
			$strWhere = "where {$condition}";
		} else
		{
			$strWhere = "";
		}
		$sql = "select {$key}, {$value} from {$table}
				{$strWhere}
				order by {$value} asc";
		
		$dbResult = $dbConn->query ( $sql );
		
		if ($dbResult->rowCount () > 0)
		{
			$result = array ();
			$array = $dbResult->getAllResult ();
			foreach ( $array as $item )
			{
				$result [$item [$key]] = $item [$value];
			}
			return $result;
		} else
		{
			return array ();
		}
	}
	
	public static function countTable($table, $condicao = null)
	{
		$dbConn = DatabaseConnectionFactory::getDefaultConnection ();
		
		if (! empty ( $condicao ))
		{
			$condicao = "where $condicao";
		} else
		{
			$condicao = "";
		}
		
		$sql = "select count(*) as num from {$table} {$condicao}";
		
		$dbResult = $dbConn->query ( $sql );
		
		if ($dbResult->rowCount () > 0)
		{
			$tmp = $dbResult->getOneResult ();
			return $tmp ['num'];
		} else
		{
			return - 1;
		}
	}
	
	public static function getSqlInsert($tabela, $records)
	{
		$keys = array_keys ( $records );
		$values = array_values ( $records );
		
		$newValues = array ();
		
		foreach ( $values as $valor )
		{
			$newValues [] = addslashes ( $valor );
		}
		
		$campos = "(" . implode ( ",", $keys ) . ")";
		$valores = "values ('" . implode ( "', '", $newValues ) . "')";
		$sql = "insert into {$tabela} {$campos} {$valores};";
		
		return $sql;
	}
	
	public static function getSqlUpdate($tabela, $records, $condicao)
	{
		$upd = array ();
		
		foreach ( $records as $key => $value )
		{
			$upd [] = "{$key}='{$value}'";
		}
		
		$dados = implode ( ", ", $upd );
		$sql = "update {$tabela} set {$dados} where {$condicao}";
		return $sql;
	}
	
	public function mudaStatus($params)
	{
		$dbConn = DatabaseConnectionFactory::getDefaultConnection ();
		
		$records [$params ['campoStatus']] = $params ['valorStatus'];
		$sql = self::getSqlUpdate ( $params ['tabela'], $records, "{$params['campoChave']} = '{$params['valorChave']}'" );
					
		try
		{
			$dbConn->query ( $sql );
			return true;
		} catch ( Exception $e )
		{
			return false;
		}
	}
}

?>
