<?php
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/base/sistema/CidadeEstadoUtil.class.php';

class LoadCidadesAction extends AbstractAction
{
	public function execute()
	{
		$response = new AjaxResponse ( );
		
		$rawRequest = $this->getRequest ();
		
		$controlValidation = CidadeEstadoUtil::validateRequest ( $rawRequest );

		if ($controlValidation->isValid ())
		{
			$cleanRequest = $controlValidation->getCleanRequest ();
			
			$optionsCidade = CidadeEstadoUtil::getMapCidade ( $cleanRequest->get ( 'idUf' ) );
			
			$arrayName = $cleanRequest->get ( 'arrayName' );
			
			$jsCidades = "{$arrayName} = new Array();";
			$i = - 1;
			
			foreach ( $optionsCidade as $idCidade => $nome )
			{
				$i ++;
				$nome = addslashes ( $nome );
				
				$jsCidades .= "{$arrayName}[{$i}] = new Array();";
				$jsCidades .= "{$arrayName}[{$i}]['txt'] = '{$nome}';";
				$jsCidades .= "{$arrayName}[{$i}]['valor'] = '{$idCidade}';";
			}
			
			$jsCidades .= "BaseAdmin.execOptions('{$cleanRequest->get('idSelect')}', {$arrayName})";
			
			$response->addScript ( $jsCidades );
		}
		
		$this->setResponse ( $response );
	}
}

?>
