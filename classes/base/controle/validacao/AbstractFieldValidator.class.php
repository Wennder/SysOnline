<?php

abstract class AbstractFieldValidator
{

	private $fieldname;
	private $message;

	public function __construct($fieldname, $message="")
	{
		$this->fieldname	= $fieldname;
		$this->message		= $message;
	}

	public function getFieldname()
	{
		return $this->fieldname;
	}

	public function getMessage()
	{
		return $this->message;
	}

	abstract public function validate($coordinator);
	
}


?>