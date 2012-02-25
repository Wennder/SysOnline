<?php
require_once 'classes/base/controle/validacao/AbstractFieldValidator.class.php';

class ArrayValidator extends AbstractFieldValidator
{
	public function validate($coordinator)
	{
		if (is_array($coordinator->get($this->getFieldname())))
		{
			$coordinator->setClean($this->getFieldname());
			return TRUE;
		} else
		{
			$coordinator->addError($this->getFieldname(), $this->getMessage());
			return FALSE;
		}
	}

}

?>