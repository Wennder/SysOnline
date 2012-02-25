<?php
require_once (dirname( __FILE__ ) . "/AbstractFieldValidator.class.php");

class FloatNaoNegativoValidator extends AbstractFieldValidator
{
	public function validate($coordinator)
	{
		$float = floatval( $coordinator->get( $this->getFieldname() ) );
		
		if ($float >= 0)
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