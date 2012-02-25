<?php
require_once (dirname(__FILE__) . "/AbstractFieldValidator.class.php");

require_once 'classes/base/controle/validacao/TamanhoImgUploadValidator.class.php';
require_once 'classes/base/controle/validacao/AbstractFieldValidator.class.php';
require_once 'classes/base/controle/validacao/ProporcaoImgUploadValidator.class.php';
require_once 'classes/base/controle/validacao/TipoImgUploadValidator.class.php';

class ImagemUploadValidator extends AbstractFieldValidator
{
	private $msgTipo;
	private $msgTamanho;
	private $msgProporcao;
	
	public function __construct($field, $msgTipo, $msgTamanho, $msgProporcao)
	{
		parent::__construct($field);
		$this->msgTipo = $msgTipo;
		$this->msgTamanho = $msgTamanho;
		$this->msgProporcao = $msgProporcao;
	}
	
	public function validate($coordinator)
	{
		$tipo = new TipoImgUploadValidator($this->getFieldname(), $this->msgTipo);
		$tamanho = new TamanhoImgUploadValidator($this->getFieldname(), $this->msgTamanho);
		$proporcao = new ProporcaoImgUploadValidator($this->getFieldname(), $this->msgProporcao);
		
		if (!$tipo->validate($coordinator))
		{
			$coordinator->addError($this->getFieldname(), $tipo->getMessage());
			return FALSE;
		} elseif (!$tamanho->validate($coordinator))
		{
			$coordinator->addError($this->getFieldname(), $tamanho->getMessage());
			return FALSE;
		} elseif (!$proporcao->validate($coordinator))
		{
			$coordinator->addError($this->getFieldname(), $proporcao->getMessage());
			return FALSE;
		} else
		{
			$coordinator->setClean($this->getFieldname());
			return TRUE;
		}
	}

}

?>