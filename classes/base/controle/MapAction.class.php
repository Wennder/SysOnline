<?php
/**
 * Repositуrio de todas as actions do sistema.
 * @author Jackson Cereb
 *
 */
class MapAction
{
	private static $actions;
	
	public function addAction($class, $file, $fluxo = 0)
	{
		self::$actions[$class]['file'] = $file;
		self::$actions[$class]['fluxo'] = $fluxo;
	}
	
	public function getAction($class)
	{
		if (array_key_exists( $class, self::$actions ))
		{
			require_once (self::$actions[$class]['file']);
			$action = new $class( );
			
			return $action;
		} else
		{
			throw new ActionNotExistException( $class );
		}
	}
	
	public function getFluxo($class)
	{
		if (array_key_exists( $class, self::$actions ))
		{
			return self::$actions[$class]['fluxo'];		
		} else
		{
			throw new ActionNotExistException( $class );
		}
	}

}

/**
 * Exceзгo lanзada quando й tentado obter uma action que nгo existe.
 * @author Jackson Cereb
 *
 */
class ActionNotExistException extends Exception
{
	public function __construct($class)
	{
		$msg = "A action solicitada ({$class}) nгo foi encontrada.";
		parent::__construct( $msg );
	}
}
?>