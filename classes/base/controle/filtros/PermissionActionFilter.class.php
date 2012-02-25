<?php
require_once 'classes/base/controle/MapAction.class.php';
require_once 'classes/base/controle/filtros/AbstractRequestFilter.class.php';
require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
/**
 * Filtro responsável por verificar permissão para executar a action solicitada.
 * @author Jackson Cereb
 *
 */
class PermissionActionFilter extends AbstractRequestFilter
{
	public static function execute($request)
	{
		$classAction = $request->getAction();
		if (($classAction != ControleAcesso::ACTION_LOGIN) and ($classAction != ControleAcesso::ACTION_LOGOFF))
		{
			$idFluxo = MapAction::getFluxo( $classAction );
			
			$result = ControleAcesso::checkPermissao( $idFluxo );
			
			if (! $result['ok'])
			{
				throw new PermissionActionFilterException( $result['nomeFluxo'] );
			}
		}
	}
}

/**
 * Exceção lançada quando a verificação de permissão para executar uma determinada action falha.
 * @author Jackson Cereb
 *
 */
class PermissionActionFilterException extends Exception
{
	public function __construct($nomeFluxo = null)
	{
		$msg = "Permissão negada para executar esta functionalidade: " . $nomeFluxo;
		parent::__construct( $msg );
	}
}

?>