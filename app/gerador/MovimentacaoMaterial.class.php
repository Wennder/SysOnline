<?php
require_once 'classes/base/entidade/ObjectDB.class.php';

class MovimentacaoMaterial extends ObjectDB
 { 
	private $idMovimentacaoMaterial;
	private $idProduto;
	private $idFornecedor;
	private $idCampus;
	private $idSetor;
	private $dataLancamento;
	private $dataMov;
	private $quantidade;
	private $retirante;
	private $documento;
	private $tipo;
	private $observacoes;
	private $corretiva;
	private $idMovimentacaoCorretiva;
	
	function __construct()
	{
		parent::__construct();
	 } 
	
	public static function getInfoTable()
	 { 
			$table['tbmovimentacao_material'][] = "idMovimentacaoMaterial";		
			$table['tbmovimentacao_material'][] = "idProduto";		
			$table['tbmovimentacao_material'][] = "idFornecedor";		
			$table['tbmovimentacao_material'][] = "idCampus";		
			$table['tbmovimentacao_material'][] = "idSetor";		
			$table['tbmovimentacao_material'][] = "dataLancamento";		
			$table['tbmovimentacao_material'][] = "dataMov";		
			$table['tbmovimentacao_material'][] = "quantidade";		
			$table['tbmovimentacao_material'][] = "retirante";		
			$table['tbmovimentacao_material'][] = "documento";		
			$table['tbmovimentacao_material'][] = "tipo";		
			$table['tbmovimentacao_material'][] = "observacoes";		
			$table['tbmovimentacao_material'][] = "corretiva";		
			$table['tbmovimentacao_material'][] = "idMovimentacaoCorretiva";		
			return $table;		
	 } 
	
	public static function getAttributesKey()
	 { 
									$key[] = "idMovimentacaoMaterial";	
					
							
							
							
							
							
							
							
							
							
							
							
							
							
						
		return $key;
	 } 
	
	final public static function getAttributeInc()
	 { 
									return "idMovimentacaoMaterial";	
					
							
							
							
							
							
							
							
							
							
							
							
							
							
			 } 
	
	
		function setIdMovimentacaoMaterial($idMovimentacaoMaterial)
	 { 
				$this->checkForUpdateHashKey();
				self::checkModify( __FUNCTION__ );
		
		$this->idMovimentacaoMaterial = $idMovimentacaoMaterial;
	 } 
	
	public function getIdMovimentacaoMaterial()
	 { 
		return $this->idMovimentacaoMaterial;
	 } 
		function setIdProduto($idProduto)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->idProduto = $idProduto;
	 } 
	
	public function getIdProduto()
	 { 
		return $this->idProduto;
	 } 
		function setIdFornecedor($idFornecedor)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->idFornecedor = $idFornecedor;
	 } 
	
	public function getIdFornecedor()
	 { 
		return $this->idFornecedor;
	 } 
		function setIdCampus($idCampus)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->idCampus = $idCampus;
	 } 
	
	public function getIdCampus()
	 { 
		return $this->idCampus;
	 } 
		function setIdSetor($idSetor)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->idSetor = $idSetor;
	 } 
	
	public function getIdSetor()
	 { 
		return $this->idSetor;
	 } 
		function setDataLancamento($dataLancamento)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->dataLancamento = $dataLancamento;
	 } 
	
	public function getDataLancamento()
	 { 
		return $this->dataLancamento;
	 } 
		function setDataMov($dataMov)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->dataMov = $dataMov;
	 } 
	
	public function getDataMov()
	 { 
		return $this->dataMov;
	 } 
		function setQuantidade($quantidade)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->quantidade = $quantidade;
	 } 
	
	public function getQuantidade()
	 { 
		return $this->quantidade;
	 } 
		function setRetirante($retirante)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->retirante = $retirante;
	 } 
	
	public function getRetirante()
	 { 
		return $this->retirante;
	 } 
		function setDocumento($documento)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->documento = $documento;
	 } 
	
	public function getDocumento()
	 { 
		return $this->documento;
	 } 
		function setTipo($tipo)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->tipo = $tipo;
	 } 
	
	public function getTipo()
	 { 
		return $this->tipo;
	 } 
		function setObservacoes($observacoes)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->observacoes = $observacoes;
	 } 
	
	public function getObservacoes()
	 { 
		return $this->observacoes;
	 } 
		function setCorretiva($corretiva)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->corretiva = $corretiva;
	 } 
	
	public function getCorretiva()
	 { 
		return $this->corretiva;
	 } 
		function setIdMovimentacaoCorretiva($idMovimentacaoCorretiva)
	 { 
				self::checkModify( __FUNCTION__ );
		
		$this->idMovimentacaoCorretiva = $idMovimentacaoCorretiva;
	 } 
	
	public function getIdMovimentacaoCorretiva()
	 { 
		return $this->idMovimentacaoCorretiva;
	 } 
	}

?>