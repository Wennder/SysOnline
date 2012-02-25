<?php

require_once (dirname( __FILE__ ) . "/AbstractFieldValidator.class.php");

class NoValidator extends AbstractFieldValidator
{
	
	public function validate($coordinator)
	{
		$coordinator->setClean( $this->getFieldname() );
		return TRUE;
	}

}

?>