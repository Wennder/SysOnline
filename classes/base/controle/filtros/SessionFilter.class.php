<?php
require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
require_once 'classes/base/controle/filtros/AbstractRequestFilter.class.php';

/**
 * Filtro responsável por verificar se a sessao do usuário ainda é válida
 * @author Jackson Cereb
 *
 */
class SessionFilter extends AbstractRequestFilter
{
	public static function execute($request)
	{
		$classAction = $request->getAction();
		if($classAction != ControleAcesso::ACTION_LOGIN)
		{
			$msg = "";
			$testSessao = ControleAcesso::testSessao();

			switch ($testSessao)
			{
				case ControleAcesso::SESSAO_EXPIRADA:
					$msg = "A sessão atual expirou: faça login novamente.";
					break;
				case ControleAcesso::SESSAO_EXCLUIDA:
					$msg = "A sessão atual não existe ou foi excluida.";
					break;

				default:
					$msg = "";
					break;
			}
			if(!empty($msg))
			{
				throw new SessionFilterException($msg);
			}
		}
	}
}

/**
 * Exceção lançada quando a verificação da sessão falha.
 * @author Jackson Cereb
 *
 */
class SessionFilterException extends Exception
{
	public function __construct($msg = null)
	{
		parent::__construct($msg);
	}
}

?>