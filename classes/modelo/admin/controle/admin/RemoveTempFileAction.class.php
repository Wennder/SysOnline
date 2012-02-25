<?php
require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'include/include.init.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/base/controle/validacao/StringNotEmptyValidator.class.php';
require_once 'classes/base/controle/validacao/ValidationFacade.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';

class RemoveTempFileAction extends AbstractAction
{
	public function execute()
	{
		$response = new AjaxResponse();
		
		$rawRequest = $this->getRequest();
		$controlValidation = new ValidationFacade();
		
		$controlValidation->addValidator(new StringNotEmpty("arquivo", "Arquivo inválido"));
		
		$controlValidation->validate($rawRequest);
		
		if ($controlValidation->isValid())
		{
			$cleanRequest = $controlValidation->getCleanRequest();
			
			$arquivo = $cleanRequest->get('arquivo');
			$filePath = DIR_BASE . "/temp/" . $arquivo;
			
			if (Seguranca::arquivoIsValido($arquivo))
			{
				if (file_exists($filePath))
				{
					unlink($filePath);
				}
			}
		}
		
		$this->setResponse($response);
	}
}

?>