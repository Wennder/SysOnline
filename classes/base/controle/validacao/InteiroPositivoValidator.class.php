<?php

require_once (dirname( __FILE__ ) . "/AbstractFieldValidator.class.php");

class InteiroPositivoValidator extends AbstractFieldValidator
{
	public function validate($coordinator)
	{
		$int = intval( $coordinator->get( $this->getFieldname() ) );
		if ($int > 0)
		{
			$coordinator->setClean( $this->getFieldname() );
			return TRUE;
		} else
		{
			$coordinator->addError( $this->getFieldname(), $this->getMessage() );
			return FALSE;
		}
	}
}

?>