<?php
require_once ('classes/base/controle/AjaxResponse.class.php');

class HTMLResponse extends AjaxResponse
{
	private $html = array ( );
	private $htmlComplete = true;
	
	public function __construct()
	{
	}
	
	public function htmlComplete($bool)
	{
		$this->htmlComplete = $bool;
	}
	
	public function addHTML($str)
	{
		$this->html [] = $str;
	}
	
	public function getHTMLString()
	{
		$html = "";
		foreach ( $this->html as $str )
		{
			$html .= $str;
		}
		
		return $html;
	}
	
	public function toBrowser()
	{
		$charset = $this->getCharset();
		header("Content-type: text/html; charset={$charset}");
		
		$html = $this->getHTMLString();
		
		if ($this->htmlComplete)
		{
			echo "<html>";
			echo "<head>";
			echo "<title></title>";
			echo "</head>";
			echo "<body>";
		}
		
		echo $html;
		
		if ($this->htmlComplete)
		{
			echo "</body>";
			echo "</html>";
		}
	}
}

?>
