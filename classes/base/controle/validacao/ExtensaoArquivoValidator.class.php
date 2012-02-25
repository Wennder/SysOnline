<?php
require_once 'classes/base/controle/validacao/AbstractFieldValidator.class.php';

class ExtensaoArquivoValidator extends AbstractFieldValidator
{
	private $extensoes;

	public function __construct($fieldName, $extensoes, $message)
	{
		parent::__construct ( $fieldName, $message );

		$this->extensoes = (count ( $extensoes ) > 0) ? $extensoes : array ();
	}

	public function validate($coordinator)
	{
		$arquivo = $coordinator->get ( $this->getFieldname () );

		$aux = explode ( ".", $arquivo ['name'] );
		$ext = $aux [count ( $aux ) - 1];

		if (array_search ( $ext, $this->extensoes ) !== FALSE)
		{
			$coordinator->setClean ( $this->getFieldname () );
			return TRUE;
		}
		else
		{
			$strExt = implode ( ', ', $this->extensoes );
			$coordinator->addError ( $this->getFieldname (), $this->getMessage () . " Os tipos permitidos são: " . $strExt . "." );
			return FALSE;
		}
	}
}

?>
