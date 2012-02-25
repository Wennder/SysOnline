<?php
require_once 'classes/base/sistema/Util.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';

class EntidadeGerador
{
	private $table;
	private $parentTable;
	private $dirDestino;
	private $pacote;
	private $prefix;
	
	public function __construct($params)
	{
		$this->table = $params ['table'];
		$this->parentTable = $params ['parentTable'];
		$this->pacote = $params ['pacote'];
		$this->prefix = $params ['prefix'];
		
		if (!empty($this->parentTable))
		{
			$params ['fields'] = self::loadFields($this->parentTable);
			$params ['class'] = self::getClassName($this->parentTable);
			$params ['classParent'] = "";
			$params ['pacote'] = "";
			$params ['table'] = $this->parentTable;
			
			$paramsSub ['fields'] = self::loadFields($this->table);
			$paramsSub ['class'] = self::getClassName($this->table);
			$paramsSub ['classParent'] = $params ['class'];
			$paramsSub ['pacote'] = $this->pacote;
			$paramsSub ['table'] = $this->table;
			
			self::generateClass($params);
			self::generateClass($paramsSub);
		} else
		{
			$params ['fields'] = self::loadFields($this->table);
			$params ['class'] = self::getClassName($this->table);
			$params ['classParent'] = "";
			$params ['pacote'] = "";
			$params ['table'] = $this->table;
			
			self::generateClass($params);
		}
	
	}
	
	private function loadFields($table)
	{
		$dbConn = DatabaseConnectionFactory::getDefaultConnection();
		
		$sql = "desc {$table}";
		
		$dbResult = $dbConn->query($sql);
		
		$itens = $dbResult->getAllResult();
		$result = array ( );
		for($i = 0; $i < count($itens); $i ++)
		{
			$result [$i] ['name'] = $itens [$i] ['Field'];
			$result [$i] ['method'] = self::nameMethodAssessor($itens [$i] ['Field']);
			$result [$i] ['key'] = ($itens [$i] ['Key'] == "PRI") ? "1" : "0";
			$result [$i] ['auto'] = ($itens [$i] ['Extra'] == "auto_increment") ? "1" : "0";
		}
		
		return $result;
	}
	
	private function nameMethodAssessor($attribute)
	{
		$attribute = str_split($attribute);
		$first = $attribute [0];
		$last = array_slice($attribute, 1);
		
		return strtoupper($first) . implode(null, $last);
	}
	
	private function getClassName($tableName)
	{
		$tableName = substr_replace($tableName, '', 0, strlen($this->prefix));
		$arrayName = explode("_", $tableName);
		$nomeClass = "";
		
		foreach ( $arrayName as $nome )
		{
			$nomeClass .= substr_replace($nome, strtoupper($nome {0}), 0, 1);
		}
		
		return $nomeClass;
	}
	
	private function generateClass($params)
	{
		$fields = $params ['fields'];
		$table = $params ['table'];
		$class = $params ['class'];
		$classParent = $params ['classParent'];
		$pacote = $params ['pacote'];
		
		if (empty($classParent))
		{
			$tpl = new ObjectGUI("gerador/class.tpl");
		} else
		{
			$tpl = new ObjectGUI("gerador/subClass.tpl");
			$tpl->assign("classParent", $classParent);
			$tpl->assign("pacote", $pacote);
		}
		
		$tpl->assign("table", $table);
		$tpl->assign("class", $class);
		$tpl->assign("fields", $fields);
		
		$codigo = $tpl->getHTML();
		
		Util::saveText($codigo, $class . ".class.php");
	}

}

?>
