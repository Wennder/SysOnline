<?php

require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/sistema/DBUtil.class.php';

class DAOCampus extends DAOObjectDB {

    function save(&$campus) {
        parent::save($campus);
    }

    function update(&$campus) {
        parent::update($campus);
    }

    public function countTotal() {
        return DBUtil::countTable("tbcampus");
    }

    public static function getMap() {

        $sql = "select tbcampus.* from tbcampus";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            $itens = $dbResult->getAllResult();
            $result = array();

            foreach ($itens as $tmp) {
                $result [$tmp ['idCampus']] = $tmp ['nome'];
            }

            return $result;
        } else {
            return false;
        }
    }

}

?>
