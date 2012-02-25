<?php
require_once 'classes/base/entidade/ObjectDB.class.php';

class Curso extends ObjectDB
 { 
	private $idCurso;
	private $nome;
	
	function __construct()
	{
		parent::__construct();
	 } 
	
	public static function getInfoTable()
	 { 
			$table['tbcurso'][] = "idCurso";		
			$table['tbcurso'][] = "nome";		
			return $table;		
	 } 
	
	public static function getAttributesKey()
	 { 
									$key[] = "idCurso";	
					
							
						
		return $key;
	 } 
	
	final public static function getAttributeInc()
	 { 
									return "idCurso";	
					
							
			 } 
	
	
		function setIdCurso($idCurso)
	 { 
				$this->checkForUpdateHashKey();
				self::checkModify( __FUNCTION__ );
		
		$this->idCurso = $idCurso;
	 } 
	
	public function getIdCurso()
	 { 
		return $this->idCurso;
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