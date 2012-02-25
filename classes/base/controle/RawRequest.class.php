<?php

class RawRequest
{
	const KEY_ACTION = "ACTION";
	const KEY_FORM_ID = "formId";
	
	private $data = array ( );
	
	public function __construct($data = FALSE)
	{
		$this->data = ($data) ? ($data) : ($this->initFromHttp());
		
		unset($_REQUEST);
		unset($_POST);
		unset($_GET);
		unset($_FILES);
	}
	
	private function initFromHttp()
	{
		$data = array ( );
		
		if (!empty($_POST))
		{
			$data = $_POST;
		}
		if (!empty($_GET))
		{
			$data = $_GET;
		}
		if (!empty($_FILES))
		{
			$data = array_merge($data, $_FILES);
		}
		
		return $data;
	}
	
	public function setData($data)
	{
		$this->data = $data;
	}
	
	public function getData()
	{
		return $this->data;
	}
	
	public function getForValidation($var)
	{
		if (isset($this->data [$var]))
		{
			return $this->data [$var];
		} else
		{
			return null;
		}
	}
	
	public function getAction()
	{
		if (isset($this->data [self::KEY_ACTION]))
		{
			return $this->data [self::KEY_ACTION];
		} else
		{
			return null;
		}
	}
	
	public function getFormId()
	{
		if (isset($this->data [self::KEY_FORM_ID]))
		{
			return $this->data [self::KEY_FORM_ID];
		} else
		{
			return null;
		}
	}

}

?>