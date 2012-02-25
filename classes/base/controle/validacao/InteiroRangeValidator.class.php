<?php
require_once (dirname(__FILE__) . "/AbstractFieldValidator.class.php");

class InteiroRangeValidator extends AbstractFieldValidator
{
	private $min;
	private $max;
	private $fieldVal;
	
	public function __construct($fieldVal, $min, $max, $message)
	{
		parent::__construct("", $message);
		
		$this->fieldVal = $fieldVal;
		$this->min = intval($min);
		$this->max = intval($max);
	}
	
	public function validate($coordinator)
	{
		if (($coordinator->get($this->fieldVal) >= $this->min) and ($coordinator->get($this->fieldVal) <= $this->max))
		{
			$coordinator->setClean($this->fieldVal);
			return TRUE;
		} else
		{
			$coordinator->addError($this->fieldVal, $this->getMessage());
			return FALSE;
		}
	
	}
}

?>