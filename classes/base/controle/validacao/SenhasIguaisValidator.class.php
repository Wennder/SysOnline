<?php
require_once 'classes/base/controle/validacao/AbstractFieldValidator.class.php';

class SenhasIguaisValidator extends AbstractFieldValidator
{
	private $fieldSenha;
	private $fieldConfSenha;
	
	public function __construct($fieldSenha, $fieldConfSenha, $message)
	{
		parent::__construct("", $message);
		
		$this->fieldSenha = (!empty($fieldSenha)) ? ($fieldSenha) : ("");
		$this->fieldConfSenha = (!empty($fieldConfSenha)) ? ($fieldConfSenha) : ("");
	}
	
	public function validate($coordinator)
	{
		$ok = true;
		
		$senha = $coordinator->get($this->fieldSenha);
		$confSenha = $coordinator->get($this->fieldConfSenha);
		
		if (strcmp($senha, $confSenha) === 0)
		{
			$coordinator->setClean($this->fieldSenha);
		} else
		{
			$coordinator->addError($this->fieldSenha, $this->getMessage());
			$coordinator->addError($this->fieldConfSenha, $this->getMessage());
			$ok = false;
		}
		
		return $ok;
	}
}

?>
