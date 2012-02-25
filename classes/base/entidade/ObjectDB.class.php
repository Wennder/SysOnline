<?php

require_once ("classes/base/entidade/ObjectPersistent.interface.php");

abstract class ObjectDB
{
	const AUTO_INCREMENT = "AUTO_INCREMENT";
	
	private $loaded = false;
	private $hashKey = null;
	private $hashMod = null;
	
	public function __construct()
	{
	}
	
	public function __destruct()
	{
	
	}
	
	public static function nameMethodAssessor($attribute)
	{
		$attribute = str_split( $attribute );
		$first = $attribute[0];
		$last = array_slice( $attribute, 1 );
		
		return strtoupper( $first ) . implode( null, $last );
	}
	
	public function checkEmptyAtributesKey()
	{
		$keys = $this->getAttributesKey();
		
		foreach ( $keys as $key )
		{
			$get = "get" . self::nameMethodAssessor( $key );
			$value = $this->$get();
			
			if (empty( $value ))
			{
				return false;
			}
		}
		
		return true;
	}
	
	final public function clearHashKey()
	{
		$this->hashKey = null;
	}
	
	public function getHashKey()
	{
		return $this->hashKey;
	}
	
	final public function checkForUpdateHashKey()
	{
		if ($this->isLoaded())
		{
			$keys = $this->getAttributesKey();
			
			foreach ( $keys as $key )
			{
				$get = "get" . self::nameMethodAssessor( $key );
				
				if (! isset( $this->hashKey[$key] ))
				{
					$this->hashKey[$key] = $this->$get();
				}
			}
		}
	}
	
	final public function checkModify($method)
	{
		$arrayM = str_split( $method );
		$arrayA = array_slice( $arrayM, 3 );
		
		$attribute = strtolower( $arrayA[0] ) . implode(array_slice( $arrayA, 1 ));
		
		$this->hashMod[$attribute] = 1;
	}
	
	function attributeModified($name)
	{
		return isset( $this->hashMod[$name] );
	}
	
	public function setLoaded($bool)
	{
		$this->loaded = ( bool ) $bool;
	}
	
	public function isLoaded()
	{
		return $this->loaded;
	}
	
	public function isKeyChanged()
	{
		return ($this->hashKey != null);
	}
	
	public static function getInfoTable()
	{
	}
	
	public static function getAttributesKey()
	{
	}
	
	public static function getAttributeInc()
	{
	}

}

?>