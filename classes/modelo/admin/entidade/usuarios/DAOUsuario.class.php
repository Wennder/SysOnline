<?php

require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/sistema/DBUtil.class.php';

class DAOUsuario extends DAOObjectDB {

    function save(&$usuario) {
        $usuario->setSenha(Seguranca::createSenha($usuario->getSenha()));
        $usuario->setDataCadastro(time());
        $usuario->setDataSenha(time());
        $usuario->setStatus(1);

        parent::save($usuario);
    }

    function update(&$usuario) {
        if ($usuario->getSenha() != "") {
            $usuario->setSenha(Seguranca::createSenha($usuario->getSenha()));
        }
        parent::update($usuario);
    }

    public static function checkExistLogin($login) {
        $dbConn = DatabaseConnectionFactory::getDefaultConnection();
        $sql = "select idUsuario from stbusuario where login = '{$login}'";
        $dbResult = $dbConn->query($sql);
        if ($dbResult->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function countTotal() {
        return DBUtil::countTable("stbusuario", "status <> '-1'");
    }

    public function mudaStatus($idUsuario, $novoStatus) {
        $dbCon = $this->getDbConn();

        $tabela = "stbusuario";
        $records ['status'] = $novoStatus;
        $sql = DBUtil::getSqlUpdate($tabela, $records, "idUsuario = '{$idUsuario}'");

        try {
            $dbCon->query($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteUser($idUsuario) {
        $dbCon = $this->getDbConn();

        $tabela = "stbusuario";
        $records ['status'] = -1;
        $records ['senha'] = sha1(time());

        $sql = DBUtil::getSqlUpdate($tabela, $records, "idUsuario = '{$idUsuario}'");

        try {
            $dbCon->query($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>
