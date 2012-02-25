<?php

require_once 'classes/base/entidade/ObjectDB.class.php';

class UsuarioInfo extends ObjectDB {

    private $nome;
    private $idUsuario;
    private $email;

    function __construct() {
        parent::__construct ();
    }

    public static function getInfoTable() {
        $table ['stbusuarioinfo'] [] = "nome";
        $table ['stbusuarioinfo'] [] = "idUsuario";
        $table ['stbusuarioinfo'] [] = "email";
        return $table;
    }

    public static function getAttributesKey() {

        $key [] = "idUsuario";

        return $key;
    }

    final public static function getAttributeInc() {

    }

    function setNome($nome) {
        self::checkModify(__FUNCTION__);

        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    function setIdUsuario($idUsuario) {
        $this->checkForUpdateHashKey();
        self::checkModify(__FUNCTION__);

        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    function setEmail($email) {
        self::checkModify(__FUNCTION__);

        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

}

?>