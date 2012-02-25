<?php

require_once("classes/base/controle/AbstractAction.class.php");

require_once("classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php");
require_once("classes/base/controle/AjaxResponse.class.php");

class FazerLogoffAction extends AbstractAction {

	public function execute() {
		
		$response = new AjaxResponse();

		ControleAcesso::sairSistema();

		$response->addRedirect("index.php");

		$this->setResponse($response);
	}
}

?>