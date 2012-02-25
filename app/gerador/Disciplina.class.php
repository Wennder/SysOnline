<?php
require_once 'classes/base/entidade/ObjectDB.class.php';

class Disciplina extends ObjectDB
 { 
	private $idDisciplina;
	private $nome;
	
	function __construct()
	{
		parent::__construct();
	 } 
	
	public static function getInfoTable()
	 { 
			$table['tbdisciplina'][] = "idDisciplina";		
			$table['tbdisciplina'][] = "nome";		
			return $table;		
	 } 
	
	public static function getAttributesKey()
	 { 
									$key[] = "idDisciplina";	
					
							
						
		return $key;
	 } 
	
	final public static function getAttributeInc()
	 { 
							
							
			 } 
	
	
		function setIdDisciplina($idDisciplina)
	 { 
				$this->checkForUpdateHashKey();
				self::checkModify( __FUNCTION__ );
		
		$this->idDisciplina = $idDisciplina;
	 } 
	
	public function getIdDisciplina()
	 { 
		return $this->idDisciplina;
	 } 
		function setNome($nome)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->nome = $nome;
	 } 
	
	public function getNome()
	 { 
		return $this->nome;
	 } 
	}

?>