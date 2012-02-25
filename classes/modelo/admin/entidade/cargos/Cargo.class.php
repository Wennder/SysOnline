<?php

require_once 'classes/base/entidade/ObjectDB.class.php';

class Cargo extends ObjectDB {

    private $idCargo;
    private $nome;

    function __construct() {
        parent::__construct();
    }

    public static function getInfoTable() {
        $table['tbcargo'][] = "idCargo";
        $table['tbcargo'][] = "nome";
        return $table;
    }

    public static function getAttributesKey() {

        $key[] = "idCargo";

        return $key;
    }

    final public static function getAttributeInc() {

    }

    function setIdCargo($idCargo) {
        $this->checkForUpdateHashKey();
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

}

?>