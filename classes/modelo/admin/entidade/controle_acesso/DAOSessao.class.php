<?php

require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/modelo/admin/entidade/controle_acesso/Sessao.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';

class DAOSessao extends DAOObjectDB
{
	public function save(&$sessao)
	{
		$sessao->setUnixtime();
		$sessao->setSessionId();
		
		self::delete( $sessao );
		
		parent::save( $sessao );
	}
	
	public function update(&$sessao)
	{
		session_regenerate_id();
		
		$sessao->setUnixtime();
		
		parent::update( $sessao );
	}
	
	public function delete(&$sessao)
	{
		parent::delete( $sessao );
	}
	
	public static function limparSessoesAntigas()
	{
		$dbConn = DatabaseConnectionFactory::getDefaultConnection();
		
		$agora = time();
		$unixtime_valido = $agora - Sessao::MAX_DURACAO;
		
		$sql = "delete from stbsessao where unixtime < '{$unixtime_valido}'";
		
		$dbConn->query( $sql );
	}
}

?>
