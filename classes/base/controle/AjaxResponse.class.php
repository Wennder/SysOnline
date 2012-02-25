<?php

class AjaxResponse
{
	const UTF_8 = "utf-8";
	const ISO_8859_1 = "iso-8859-1";
	const CONTENT_TYPE = "text/javascript";
	
	private $charset = self::ISO_8859_1;
	private $commandsJS = array ( );
	private $asHTML = false;
	
	public function __construct()
	{
	}
	
	public function getCharset()
	{
		return $this->charset;
	}
	
	public function sendAsHTML()
	{
		$this->asHTML = TRUE;
	}
	
	private function escapeBreakLines($string)
	{
		$string = str_replace("\n", "\\n", $string);
		$string = str_replace("\r", "\\r", $string);
		
		return $string;
	}
	
	public function addAssign($idElement, $attribute, $value)
	{
		$value = self::escapeBreakLines($value);
		$value = str_replace("'", "\\'", $value);
		$this->commandsJS [] = "$('{$idElement}').{$attribute} = '{$value}';";
	}
	
	public function addScript($script)
	{
		$this->commandsJS [] = $script;
	}
	
	public function addAlert($string)
	{
		$string = str_replace("'", "\\'", $string);
		$this->commandsJS [] = "alert('{$string}');";
	}
	
	public function addRedirect($string)
	{
		$this->commandsJS [] = "document.location = '{$string}';";
	}
	
	public function getJS()
	{
		$js = "";
		foreach ( $this->commandsJS as $command )
		{
			$js .= self::escapeBreakLines($command) . "\n";
		}
		
		return $js;
	}
	
	public function toBrowser()
	{
		$js = $this->getJS();
		
		if ($this->asHTML)
		{
			self::toBrowserHTML($js);
		} else
		{
			$contentType = self::CONTENT_TYPE;
			$charset = $this->charset;
			
			header("Content-type: {$contentType}; charset={$charset}");
			echo $js;
		}
	}
	
	private function toBrowserHTML($js)
	{
		$charset = $this->charset;
		header("Content-type: text/html; charset={$charset}");
		
		echo "<html>";
		echo "<head>";
		echo "<title></title>";
		echo "</head>";
		echo "<body>";
		echo "<script language=\"javascript\" type=\"text/javascript\">";
		echo $js;
		echo "</script>";
		echo "</body>";
		echo "</html>";
	
	}

}

?>