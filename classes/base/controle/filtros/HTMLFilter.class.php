<?php
require_once 'classes/base/sistema/Util.class.php';
require_once 'classes/base/controle/filtros/AbstractRequestFilter.class.php';
/**
 * Filtro responsável por filtrar codigo html
 * @author Jackson Cereb
 */
class HTMLFilter extends AbstractRequestFilter
{
	private function camposHTML($action)
	{
		$campos['ExecCadNoticiaAction'][] = 'texto';
		$campos['ExecEditNoticiaAction'][] = 'texto';
		$campos['ExecCadVideoAction'][] = 'embed';
		$campos['ExecEditVideoAction'][] = 'embed';
		
		if (isset( $campos[$action] ))
		{
			return $campos[$action];
		} else
		{
			return array ( );
		}
	}
	
	public static function execute($request)
	{
		$dados = $request->getData();
		
		$action = $request->getAction();
		$campos = self::camposHTML($action);
		
		foreach ( $dados as $campo => $valor )
		{
			if (array_search( $campo, $campos ) === false)
			{
				$dados[$campo] = Seguranca::clearTags( $valor );
			}
		}
		
		$request->setData( $dados );
	}
}
?>