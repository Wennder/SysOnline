<?php
require_once 'classes/base/controle/filtros/AbstractRequestFilter.class.php';
require_once 'classes/base/sistema/Seguranca.class.php';

/**
 * Filtro responsсvel por verificar ataques de SQL Injection
 * @author Jackson Cereb
 *
 */
class SQLInjectionFilter extends AbstractRequestFilter
{
	public static function execute($request)
	{
		$dados = $request->getData();
		
		$dados = Seguranca::clear($dados);

		$request->setData($dados);
	}
}

/**
 * Exceчуo lanчada quando a verificaчуo de SQL Injection falha.
 * Por enquanto, a verificaчуo de SQL Injection apenas limpa os dados sem retornar nada.
 * @author Jackson Cereb
 *
 */
class SQLInjectionFilterException extends Exception
{
	public function __construct()
	{
		$msg = "Os dados dessa requisiчуo nуo passram no filtro de SQL Injection";
		parent::__construct($msg);
	}
}

?>