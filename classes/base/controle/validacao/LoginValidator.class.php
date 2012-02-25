<?php

require_once (dirname( __FILE__ ) . "/AbstractFieldValidator.class.php");

class LoginValidator extends AbstractFieldValidator
{
	
	public function validate($coordinator)
	{
		if (Seguranca::loginIsValido( $coordinator->get( $this->getFieldname() ) ))
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