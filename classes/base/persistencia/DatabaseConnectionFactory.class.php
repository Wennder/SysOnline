<?php
require_once 'classes/base/persistencia/MysqlIConnection.class.php';

class DatabaseConnectionFactory
{
	private static $defaultDbConn = null;
	
	public static function createConnection($params)
	{
		$driver = $params['driver'];
		
		$dbConn = null;
		
		switch ( $driver)
		{
			case MysqlIConnection::keyDriver() :
				$dbConn = new MysqlIConnection( $params );
				break;
			
			default :
				throw new Exception( "Dados incorretos para criar conexão ao banco de dados." );
				break;
		}
		
		return $dbConn;
	}
	
	public static function getDefaultConnection()
	{
		if (self::$defaultDbConn != null)
		{
			return self::$defaultDbConn;
		}
		
		$params['driver'] = "mysqli";
		$params['host'] = "localhost";
		$params['user'] = "root";
		$params['password'] = "root";
		$params['port'] = null;
		$params['dbname'] = "dbauditoria";

		/*$params['driver'] = "mysqli";
		$params['host'] = "mysql02.paroquiasaofranciscodeassis.com";
		$params['user'] = "paroquiasaofra1";
		$params['password'] = "pascom1021557";
		$params['port'] = null;
		$params['dbname'] = "paroquiasaofra1";*/
		
		self::$defaultDbConn = self::createConnection( $params );
		
		return self::$defaultDbConn;
	}
}

?>
