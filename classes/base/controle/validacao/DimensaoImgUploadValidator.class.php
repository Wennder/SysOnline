<?php

require_once (dirname( __FILE__ ) . "/AbstractFieldValidator.class.php");

class DimensaoImgUploadValidator extends AbstractFieldValidator
{
	private $width;
	private $height;
	
	public function __construct($width, $height, $fieldname, $message)
	{
		parent::__construct( $fieldname, $message );
		
		$this->width = $width;
		$this->height = $height;
	}
	
	public function validate($coordinator)
	{
		$arquivo = $coordinator->get( $this->getFieldname() );
		$info = getimagesize( $arquivo['tmp_name'] );
		
		$widthOK = ($info[0] == $this->width);
		$heightOK = ($info[1] == $this->height);
		
		if ($widthOK and $heightOK)
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