<?php
require_once 'classes/base/interface/ObjectGUI.class.php';

abstract class AbstractGuiComp extends ObjectGUI
{
	private $hashParam;
	
	public function __construct($params = null)
	{
		parent::__construct();
		
		$this->hashParam = $params;
	}
	
	public function getParam($key)
	{
		if (isset( $this->hashParam[$key] ))
		{
			return $this->hashParam[$key];
		} else
		{
			return NULL;
		}
	}
	
	abstract function getHTMLComp();
}
?>