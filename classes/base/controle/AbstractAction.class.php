<?php

abstract class AbstractAction
{
	private $request;
	private $response;

	public function setRequest($request)
	{
		$this->request = $request;
	}
	
	public function getRequest(){
		return $this->request;
	}
	
	public function setResponse($response)
	{
		$this->response = $response;
	}

	public function getResponse()
	{
		return $this->response;
	}

	abstract function execute();
}

?>