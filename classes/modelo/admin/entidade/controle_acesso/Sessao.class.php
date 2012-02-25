<?php

require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once ("classes/base/entidade/ObjectDB.class.php");

class Sessao extends ObjectDB
{
	const KEY_CHAVE_ESTENDIDA = "CHAVE_ESTENDIDA";
	const CHAVE_BASE = "CEREB";
	const MAX_DURACAO = 3600;
	
	private $sessionId;
	private $idUsuario;
	private $unixtime;
	
	function __construct()
	{
		parent::__construct();
	}
	
	public static function getInfoTable()
	{
		$table['stbsessao'][] = "sessionId";
		$table['stbsessao'][] = "idUsuario";
		$table['stbsessao'][] = "unixtime";
		
		return $table;
	}
	
	public static function getAttributesKey()
	{
		$key[] = "sessionId";
		
		return $key;
	}
	
	private function createChaveExtendida()
	{
		$_SESSION[self::KEY_CHAVE_ESTENDIDA] = md5( uniqid( time() ) );
	}
	
	private function chaveExtendida()
	{
		if ((! isset( $_SESSION[self::KEY_CHAVE_ESTENDIDA] )) or (empty( $_SESSION[self::KEY_CHAVE_ESTENDIDA] )))
		{
			self::createChaveExtendida();
		}
		return $_SESSION[self::KEY_CHAVE_ESTENDIDA];
	}
	
	private function getChave()
	{
		return sha1( self::CHAVE_BASE . self::chaveExtendida() );
	}
	
	public function setSessionId()
	{
		self::checkModify( __FUNCTION__ );
		$this->sessionId = self::getChave();
	}
	
	public function getSessionId()
	{
		return $this->sessionId;
	}
	
	public function setIdUsuario($idUsuario)
	{
		self::checkModify( __FUNCTION__ );
		return $this->idUsuario = $idUsuario;
	}
	
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}
	
	public function setUnixtime($unixTime = 0)
	{
		self::checkModify( __FUNCTION__ );
		$unixTime = ( int ) $unixTime;
		if ($unixTime > 0)
		{
			$this->unixtime = $unixTime;
		} else
		{
			$this->unixtime = time();
		}
	}
	
	public function getUnixtime()
	{
		return $this->unixtime;
	}
	
	public function checkDuracao()
	{
		$agora = time();
		$unixtime_valido = $agora - self::MAX_DURACAO;
		if ($this->unixtime >= $unixtime_valido)
		{
			return true;
		} else
		{
			return false;
		}
	}
	
	public static function unsetChaveExtendida()
	{
		unset( $_SESSION[self::KEY_CHAVE_ESTENDIDA] );
	}
}
?>