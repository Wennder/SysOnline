<?php

require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/sistema/DBUtil.class.php';

class DAOCargo extends DAOObjectDB {

    function save(&$cargo) {
        parent::save($cargo);
    }

    function update(&$cargo) {
        parent::update($cargo);
    }

    public function countTotal() {
        return DBUtil::countTable("tbcargo");
    }

    public static function getMap() {

        $sql = "select tbcargo.* from tbcargo";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            $itens = $dbResult->getAllResult();
            $result = array();

            foreach ($itens as $tmp) {
                $result [$tmp ['idCargo']] = $tmp ['nome'];
            }

            return $result;
        } else {
            return false;
        }
    }

}

?>
