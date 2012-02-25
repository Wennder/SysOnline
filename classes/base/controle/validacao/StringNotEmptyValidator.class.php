<?php

require_once (dirname ( __FILE__ ) . "/AbstractFieldValidator.class.php");

class StringNotEmptyValidator extends AbstractFieldValidator
{
	public function validate($coordinator)
	{
		$str = $coordinator->get ( $this->getFieldname () );
		if ($str != "")
		{
			$coordinator->setClean ( $this->getFieldname () );
			return TRUE;
		} else
		{
			$coordinator->addError ( $this->getFieldname (), $this->getMessage () );
			return FALSE;
		}
	}
}

?>