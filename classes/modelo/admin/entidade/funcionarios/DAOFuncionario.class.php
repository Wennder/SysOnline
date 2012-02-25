<?php

require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/sistema/DBUtil.class.php';

class DAOFuncionario extends DAOObjectDB {

    function save(&$funcionario) {
        $funcionario->setStatus(1);

        parent::save($funcionario);
    }

    function update(&$funcionario) {
        parent::update($funcionario);
    }

    public function countTotal() {
        return DBUtil::countTable("tbfuncionario");
    }

    public function mudaStatus($idFuncionario, $novoStatus) {
        $dbCon = $this->getDbConn();

        $tabela = "tbfuncionario";
        $records ['status'] = $novoStatus;
        $sql = DBUtil::getSqlUpdate($tabela, $records, "idFuncionario = '{$idFuncionario}'");

        try {
            $dbCon->query($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteFunc($idFuncionario) {
        $dbCon = $this->getDbConn();

        $tabela = "tbfuncionario";
        $records ['status'] = -1;

        $sql = DBUtil::getSqlUpdate($tabela, $records, "idFuncionario = '{$idFuncionario}'");

        try {
            $dbCon->query($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getMapAutoComplete($nome) {
        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $sql = "SELECT idFuncionario, nome, cpf, matricula FROM tbfuncionario WHERE nome LIKE '%{$nome}%' or cpf LIKE '%{$nome}%' or matricula LIKE '%{$nome}%' and tbfuncionario.status != -1 ORDER BY nome ASC";

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            $array = $dbResult->getAllResult();

            return $array;
        } else {
            return array();
        }
    }

    public static function getNomeECpfFuncionarioById($idFuncionario) {
        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $sql = "SELECT idFuncionario, nome, cpf, matricula FROM tbfuncionario WHERE idFuncionario = {$idFuncionario}";

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            $array = $dbResult->getOneResult();

            return $array;
        } else {
            return array();
        }
    }

}

?>
