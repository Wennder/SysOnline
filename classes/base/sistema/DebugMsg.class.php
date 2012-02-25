<?php

class DebugMsg
{
	private $msg;
	
	function __construct()
	{
		$this->msg = array ( );
	
	}
	
	public function addMsg($msg)
	{
		$this->msg [time()] = $msg;
	}
	
	public function getMsg()
	{
		return $this->msg;
	}
}

?>
