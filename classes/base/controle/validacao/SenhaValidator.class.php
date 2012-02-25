<?php

require_once(dirname(__FILE__) . "/AbstractFieldValidator.class.php");

class SenhaValidator extends AbstractFieldValidator
{

	public function validate($coordinator)
	{
		if (Seguranca::senhaIsValida($coordinator->get($this->getFieldname())))
		{
			$coordinator->setClean($this->getFieldname());
			return TRUE;
		}
		else
		{
			$coordinator->addError($this->getFieldname(), $this->getMessage());
			return FALSE;
		}
	}

}

?>