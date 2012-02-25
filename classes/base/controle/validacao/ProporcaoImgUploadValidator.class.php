<?php

require_once (dirname ( __FILE__ ) . "/AbstractFieldValidator.class.php");

class ProporcaoImgUploadValidator extends AbstractFieldValidator
{
	const PROPORCAO_HORIZONTAL = 1.333; // 4/3	

	public function validate($coordinator)
	{
		$arquivo = $coordinator->get ( $this->getFieldname () );
		$info = getimagesize ( $arquivo ['tmp_name'] );
		
		$p = round ( $info [0] / $info [1], 3 );
		
		if ($p >= (self::PROPORCAO_HORIZONTAL - 0.01) and ($p <= self::PROPORCAO_HORIZONTAL + 0.01))
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