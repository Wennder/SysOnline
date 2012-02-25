<?php
require_once 'classes/base/controle/AjaxResponse.class.php';

class AjaxTextResponse extends AjaxResponse
{
	private $commandsTxt = array ();

	public function __construct()
	{
		$this->charset = self::ISO_8859_1;
	}

	public function addTxt($script)
	{
		$this->commandsTxt [] = $script;
	}

	public function getTxt()
	{
		$txt = "";

		foreach ( $this->commandsTxt as $command )
		{
			$txt .= $command . "\n";
		}

		return $txt;
	}

	public function toBrowser()
	{
		$contentType = self::CONTENT_TYPE;
		$charset = $this->charset;

		header ( "Content-type: {$contentType}; charset={$charset}" );

		echo $this->getTxt ();
	}
}

?>