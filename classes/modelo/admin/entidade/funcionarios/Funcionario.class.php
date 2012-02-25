<?php

require_once 'classes/base/entidade/ObjectDB.class.php';

class Funcionario extends ObjectDB {

    private $idFuncionario;
    private $idCampus;
    private $idCargo;
    private $nome;
    private $cpf;
    private $matricula;
    private $rg;
    private $pis;
    private $status;

    function __construct() {
        parent::__construct();
    }

    public static function getInfoTable() {
        $table['tbfuncionario'][] = "idFuncionario";
        $table['tbfuncionario'][] = "idCampus";
        $table['tbfuncionario'][] = "idCargo";
        $table['tbfuncionario'][] = "nome";
        $table['tbfuncionario'][] = "cpf";
        $table['tbfuncionario'][] = "matricula";
        $table['tbfuncionario'][] = "rg";
        $table['tbfuncionario'][] = "pis";
        $table['tbfuncionario'][] = "status";
        return $table;
    }

    public static function getAttributesKey() {
        $key[] = "idFuncionario";

        return $key;
    }

    final public static function getAttributeInc() {
        return "idFuncionario";
    }

    function setIdFuncionario($idFuncionario) {
        $this->checkForUpdateHashKey();
        self::checkModify(__FUNCTION__);

        $this->idFuncionario = $idFuncionario;
    }

    public function getIdFuncionario() {
        return $this->idFuncionario;
    }

    function setIdCampus($idCampus) {
        self::checkModify(__FUNCTION__);

        $this->idCampus = $idCampus;
    }

    public function getIdCampus() {
        return $this->idCampus;
    }

    function setIdCargo($idCargo) {
        self::checkModify(__FUNCTION__);

        $this->idCargo = $idCargo;
    }

    public function getIdCargo() {
        return $this->idCargo;
    }

    function setNome($nome) {
        self::checkModify(__FUNCTION__);

        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    function setCpf($cpf) {
        self::checkModify(__FUNCTION__);

        $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
    }

    function setMatricula($matricula) {
        self::checkModify(__FUNCTION__);

        $this->matricula = $matricula;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    function setRg($rg) {
        self::checkModify(__FUNCTION__);

        $this->rg = $rg;
    }

    public function getRg() {
        return $this->rg;
    }

    function setPis($pis) {
        self::checkModify(__FUNCTION__);

        $this->pis = $pis;
    }

    public function getPis() {
        return $this->pis;
    }

    function setStatus($status) {
        self::checkModify(__FUNCTION__);

        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

}

?>