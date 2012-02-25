<?php
require_once ("classes/base/controle/validacao/ValidationCoordinator.class.php");
require_once ("classes/base/controle/CleanRequest.class.php");

class ValidationFacade
{
	private $coordinator;
	private $validators = array ( );
	private $hasValidated = FALSE;
	
	public function addValidator($validator)
	{
		$this->validators [] = $validator;
	}
	
	public function validate($request)
	{
		$this->coordinator = $this->createCoordinator($request, new CleanRequest());
		foreach ( $this->validators as $validator )
		{
			$validator->validate($this->coordinator);
		}
		$this->hasValidated = TRUE;
		
		return $this->isValid();
	}
	
	public function isValid()
	{
		if (!$this->hasValidated)
		{
			return FALSE;
		}
		
		return (count($this->coordinator->getErrors()) == 0);
	}
	
	public function createCoordinator($raw, $clean)
	{
		return new ValidationCoordinator($raw, $clean);
	}
	
	public function getCleanRequest()
	{
		if (!$this->isValid())
		{
			return FALSE;
		}
		
		return $this->coordinator->getCleanRequest();
	}
	
	public function getErrors()
	{
		if ($this->isValid())
		{
			return FALSE;
		}
		
		return $this->coordinator->getErrors();
	}
	
	public function getErrosAsString()
	{
		$erros = $this->getErrors();
		$msg = "";
		
		foreach ( $erros as $erro )
		{
			$msg .= $erro . "<br />\n";
		}
		
		return $msg;
	}

}

?>