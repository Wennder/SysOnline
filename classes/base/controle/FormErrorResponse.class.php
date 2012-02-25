<?php
require_once("classes/base/controle/AjaxResponse.class.php");

class FormErrorResponse extends AjaxResponse
{
	public function __construct()
	{
		parent::__construct();
	}

	function prepare($erros, $formId)
	{		
		$fields = array_keys($erros);

		$this->addScript("FormUtil.resetErrors('{$formId}')");
		$this->addScript("FormUtil.setFocus('{$formId}', '{$fields[0]}')");
						
		foreach ($erros as $field => $mensagem)
		{
			$this->addScript("FormUtil.setError('{$formId}', '{$field}', '{$mensagem}')");
		}
	}


}
?>