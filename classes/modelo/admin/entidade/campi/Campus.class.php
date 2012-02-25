<?php

require_once 'classes/base/entidade/ObjectDB.class.php';

class Campus extends ObjectDB {

    private $idCampus;
    private $nome;

    function __construct() {
        parent::__construct();
    }

    public static function getInfoTable() {
        $table['tbcampus'][] = "idCampus";
        $table['tbcampus'][] = "nome";
        return $table;
    }

    public static function getAttributesKey() {

        $key[] = "idCampus";

        return $key;
    }

    final public static function getAttributeInc() {

        return "idCampus";
    }

    function setIdCampus($idCampus) {
        $this->checkForUpdateHashKey();
        self::checkModify(__FUNCTION__);

        $this->idCampus = $idCampus;
    }

    public function getIdCampus() {
        return $this->idCampus;
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