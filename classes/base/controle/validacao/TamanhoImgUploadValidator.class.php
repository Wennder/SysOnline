<?php

require_once (dirname(__FILE__) . "/AbstractFieldValidator.class.php");

class TamanhoImgUploadValidator extends AbstractFieldValidator
{
	const MAX_SIZE = 1048576; //1MB
	

	public function validate($coordinator)
	{
		$arquivo = $coordinator->get($this->getFieldname());
		
		if ($arquivo ['size'] <= self::MAX_SIZE)
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