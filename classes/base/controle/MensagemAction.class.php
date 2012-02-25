<?php
require_once ("classes/base/controle/AbstractAction.class.php");

require_once ("classes/base/controle/AjaxResponse.class.php");

class MensagemAction extends AbstractAction
{
	public function idFluxo()
	{
		return 0;
	}
	
	public function execute()
	{
		$dado = $this->getRequest();
		
		if ($dado instanceof Exception)
		{
			$mensagem = $dado->getMessage();
		} else
		{
			$mensagem = $dado->getForValidation("info");
		}
		
		$response = new AjaxResponse();
		$response->addAlert($mensagem);
		
		$this->setResponse($response);
	}
}

?>