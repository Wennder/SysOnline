<?php

require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/sistema/DBUtil.class.php';

class DAOCurso extends DAOObjectDB {

    function save(&$curso) {
        parent::save($curso);
    }

    function update(&$curso) {
        parent::update($curso);
    }

    public function countTotal() {
        return DBUtil::countTable("tbcurso");
    }

    public static function getMap() {

        $sql = "select tbcurso.* from tbcurso";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            $itens = $dbResult->getAllResult();
            $result = array();

            foreach ($itens as $tmp) {
                $result [$tmp ['idCurso']] = $tmp ['nome'];
            }

            return $result;
        } else {
            return false;
        }
    }

}

?>
