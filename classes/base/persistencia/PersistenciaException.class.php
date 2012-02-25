<?php
class PersistenciaException extends Exception
{
	private $parent;
	
	public function __construct($message, $code, $parent)
	{
		parent::__construct($message, $code);
		
		$this->parent = $parent;
	}
}

?>
