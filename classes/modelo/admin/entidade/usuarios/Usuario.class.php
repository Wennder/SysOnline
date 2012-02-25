<?php

require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/sistema/Seguranca.class.php';
require_once ("classes/base/entidade/ObjectDB.class.php");

class Usuario extends ObjectDB {
    const DURACAO_SENHA = 2592000;

    private $idUsuario;
    private $login;
    private $senha;
    private $dataSenha;
    private $dataCadastro;
    private $status;

    function __construct($idUsuario = null) {
        parent::__construct();

        if ($idUsuario != null) {
            $this->setIdUsuario($idUsuario);
            $this->load();
        }
    }

    public static function getInfoTable() {
        $table ['stbusuario'] [] = "idUsuario";
        $table ['stbusuario'] [] = "login";
        $table ['stbusuario'] [] = "senha";
        $table ['stbusuario'] [] = "dataSenha";
        $table ['stbusuario'] [] = "dataCadastro";
        $table ['stbusuario'] [] = "status";

        return $table;
    }

    public static function getAttributesKey() {
        $key [] = "idUsuario";

        return $key;
    }

    final public static function getAttributeInc() {
        return "idUsuario";
    }

    public function setIdUsuario($idUsuario) {
        $this->checkForUpdateHashKey();
        self::checkModify(__FUNCTION__);
        return $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setLogin($login) {
        self::checkModify(__FUNCTION__);
        return $this->login = $login;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setSenha($senha) {
        self::checkModify(__FUNCTION__);
        return $this->senha = $senha;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setDataSenha($data) {
        self::checkModify(__FUNCTION__);
        return $this->dataSenha = $data;
    }

    public function getDataSenha() {
        return $this->dataSenha;
    }

    public function setDataCadastro($data) {
        self::checkModify(__FUNCTION__);
        return $this->dataCadastro = $data;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    public function setStatus($status) {
        self::checkModify(__FUNCTION__);
        return $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function checkDataSenha() {
        $agora = time();
        $dataValida = $agora - self::DURACAO_SENHA;
        if ($this->dataSenha >= $dataValida) {
            return true;
        } else {
            return false;
        }
    }

    //@todo deve ir para um dao?
    function execLogin($login, $senha) {
        $dbConn = DatabaseConnectionFactory::getDefaultConnection();

        $senha = Seguranca::createSenha($senha);
        $sql = "select idUsuario from stbusuario where login = '{$login}' and senha = '{$senha}' and status = '1'";
        $dbResult = $dbConn->query($sql);
        if ($dbResult->rowCount() > 0) {
            $aux = $dbResult->getOneResult();
            $this->idUsuario = $aux ['idUsuario'];
            return true;
        } else {
            return false;
        }
    }

}

?>