<?php

class ValidationCoordinator
{
	private $raw;
	private $clean;
	private $errors = array();

	public function __construct($raw, $clean)
	{
		$this->raw = $raw;
		$this->clean = $clean;
	}

	public function get($name)
	{
		return $this->raw->getForValidation($name);
	}

	public function setClean($name = FALSE)
	{
		if (!$name)
		{
			return FALSE;
		}

		$this->clean = $this->clean->set($name,	$this->raw->getForValidation($name));

		return true;
	}

	public function addError($field, $error)
	{
		$this->errors[$field] = $error;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function getCleanRequest()
	{
		return $this->clean;
	}

}

?>