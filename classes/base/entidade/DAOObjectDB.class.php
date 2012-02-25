<?php

require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/persistencia/PersistenciaException.class.php';
require_once 'classes/base/entidade/ObjectPersistent.interface.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';

class DAOObjectDB implements ObjectPersistent {
    const AUTO_INCREMENT = "AUTO_INCREMENT";

    private $dbConn = null;
    private $debugMsg = array();

    public function __construct() {
        $this->setDbConn();
    }

    public function __destruct() {
        $this->dbConn->__destruct();
    }

    final public function addDebugMsg($strMsg) {
        $msg ['time'] = time ();
        $msg ['msg'] = $strMsg;
        $this->debugMsg [] = $msg;
    }

    final public function getDebugMsg() {
        return $this->debugMsg;
    }

    public function setDbConn($dbConn = null) {
        if ($dbConn == null) {
            $this->dbConn = DatabaseConnectionFactory::getDefaultConnection ();
        }
    }

    public function getDbConn() {
        return $this->dbConn;
    }

    public function save(&$objectDB) {
        $infoTable = $objectDB->getInfoTable();
        $tablePrinc = key($infoTable);

        $attributeInc = $objectDB->getAttributeInc();
        $hasAutoInc = (!empty($attributeInc));

        foreach ($infoTable as $table => $attributes) {
            $fieldsAux = array();

            $valuesAux = array();

            foreach ($attributes as $attribute) {
                if ($table == $tablePrinc) {
                    if ($attribute != $objectDB->getAttributeInc()) {
                        $get = "get" . $objectDB->nameMethodAssessor($attribute);

                        $fieldsAux [] = $attribute;
                        $valuesAux [] = "'" . addslashes($objectDB->$get()) . "'";
                    }
                } else {
                    if ($attribute == $objectDB->getAttributeInc()) {
                        $value = self::AUTO_INCREMENT;
                    } else {
                        $get = "get" . $objectDB->nameMethodAssessor($attribute);
                        $value = $objectDB->$get();
                    }

                    $fieldsAux [] = $attribute;
                    $valuesAux [] = "'" . addslashes($value) . "'";
                }
            }

            $fields = implode(", ", $fieldsAux);
            $values = implode(", ", $valuesAux);

            $sqlArray [] = "insert into {$table} ({$fields}) values ({$values})";
        }

        try {
            $lastId = 0;
            $set = "set" . $objectDB->nameMethodAssessor($objectDB->getAttributeInc());

            foreach ($sqlArray as $sql) {
                if ($lastId > 0) {
                    $sql = str_replace(self::AUTO_INCREMENT, $lastId, $sql);
                }

                $this->getDbConn()->query($sql);
                $this->addDebugMsg("Query executada no método save(): " . $sql);

                if ($hasAutoInc and ($lastId == 0)) {
                    $lastId = $this->dbConn->lastInsertId();
                    $objectDB->$set($lastId);
                }
            }
        } catch (Exception $e) {
            throw new PersistenciaException("Falha ao executar o método save", 0, $e);
        }
    }

    public function load(&$objectDB) {
        if (!$objectDB->checkEmptyAtributesKey()) {
            $objectDB->setLoaded(false);
            return false;
        }

        $infoTable = $objectDB->getInfoTable();
        $tablePrinc = key($infoTable);

        foreach ($infoTable as $table => $attributes) {
            foreach ($attributes as $attribute) {
                $fieldsAux [] = "{$table}.{$attribute}";
            }
        }

        $fields = implode(", ", $fieldsAux);

        if (count($infoTable) > 1) {
            array_shift($infoTable);

            foreach ($infoTable as $table => $attributes) {
                $keys = $objectDB->getAttributesKey();

                $keysAux = array();

                foreach ($keys as $key) {
                    $keysAux [] = "{$tablePrinc}.{$key} = {$table}.{$key}";
                }

                $strKeys = implode(" and ", $keysAux);
                $joinAux [] = " inner join {$table} on ({$strKeys})";
            }

            $join = implode(" ", $joinAux);
        } else {
            $join = "";
        }

        $keys = $objectDB->getAttributesKey();

        foreach ($keys as $key) {
            $get = "get" . $objectDB->nameMethodAssessor($key);
            $whereAux [] = "{$tablePrinc}.{$key} = " . "'" . addslashes($objectDB->$get()) . "'";
        }

        $where = "where " . implode(" and ", $whereAux);
        $sql = "select {$fields} from {$tablePrinc} {$join} {$where}";

        try {
            $dbResult = $this->getDbConn()->query($sql);
            $this->addDebugMsg("Query executada no método load(): " . $sql);

            if ($dbResult->rowCount() > 0) {
                $dados = $dbResult->getOneResult();

                $this->fromArray($dados, $objectDB);

                $objectDB->clearHashKey();

                $objectDB->setLoaded(true);

                return true;
            } else {
                $objectDB->setLoaded(false);
                return false;
            }
        } catch (Exception $e) {
            throw new PersistenciaException("Falha ao executar o método load", 0, $e);
        }
    }

    public function update(&$objectDB) {
        $infoTable = $objectDB->getInfoTable();
        $keys = $objectDB->getAttributesKey();
        $tablePrinc = key($infoTable);

        if ($objectDB->isKeyChanged()) {
            foreach ($objectDB->getHashKey() as $key => $value) {
                $whereAuxChange [] = "{$key} = " . "'" . addslashes($value) . "'";
            }

            $whereChange = "where " . implode(" and ", $whereAuxChange);
        } else {
            $whereChange = "";
        }

        foreach ($keys as $key) {
            $get = "get" . $objectDB->nameMethodAssessor($key);
            $whereAuxKeys [] = "{$key} = " . "'" . addslashes($objectDB->$get()) . "'";
        }

        $whereKeys = "where " . implode(" and ", $whereAuxKeys);

        foreach ($infoTable as $table => $attributes) {
            $fieldsAux = array();
            foreach ($attributes as $attribute) {
                if ($objectDB->isKeyChanged()) {
                    if (($table == $tablePrinc) or (!in_array($attribute, $keys))) {
                        if ($objectDB->attributeModified($attribute)) {
                            $get = "get" . $objectDB->nameMethodAssessor($attribute);
                            $fieldsAux [] = "{$attribute} = " . "'" . addslashes($objectDB->$get()) . "'";
                        }
                    }
                } elseif (!in_array($attribute, $keys)) {
                    if ($objectDB->attributeModified($attribute)) {
                        $get = "get" . $objectDB->nameMethodAssessor($attribute);
                        $fieldsAux [] = "{$attribute} = " . "'" . addslashes($objectDB->$get()) . "'";
                    }
                }
            }

            if (count($fieldsAux) > 0) {
                $fields = implode(", ", $fieldsAux);

                if ($objectDB->isKeyChanged()) {
                    if ($table == $tablePrinc) {
                        $where = $whereChange;
                    } else {
                        $where = $whereKeys;
                    }
                } else {
                    $where = $whereKeys;
                }

                $sqlArray [] = "update {$table} set {$fields} {$where}";
            }
        }

        try {
            foreach ($sqlArray as $sql) {
                $this->getDbConn()->query($sql);
                $this->addDebugMsg("Query executada no método update(): " . $sql);
            }
        } catch (Exception $e) {
            throw new PersistenciaException("Falha ao executar o método update", 0, $e);
        }
    }

    //@todo modificar para gerar queries para todas as sub classes
    public function delete(&$objectDB) {
        if (!$objectDB->checkEmptyAtributesKey()) {
            $objectDB->setLoaded(false);
            return false;
        }

        $infoTable = $objectDB->getInfoTable();
        $tablePrinc = key($infoTable);
        $keys = $objectDB->getAttributesKey();

        foreach ($keys as $key) {
            $get = "get" . $objectDB->nameMethodAssessor($key);
            $whereAuxKeys [] = "{$key} = " . "'" . addslashes($objectDB->$get()) . "'";
        }

        $whereKeys = "where " . implode(" and ", $whereAuxKeys);
        $sql = "delete from {$tablePrinc} {$whereKeys}";

        try {
            $this->getDbConn()->query($sql);
            $this->addDebugMsg("Query executada no método delete(): " . $sql);
            return TRUE;
        } catch (Exception $e) {
            throw new PersistenciaException("Falha ao executar o método delete", 0, $e);
        }
    }

    function fromArray($array, &$objectDB) {
        $infoTable = $objectDB->getInfoTable();

        foreach ($infoTable as $attributes) {
            foreach ($attributes as $attribute) {
                $set = "set" . $objectDB->nameMethodAssessor($attribute);
                $objectDB->$set($array [$attribute]);
            }
        }

        $objectDB->setLoaded(true);
    }

    function toArray(&$objectDB) {
        $infoTable = $objectDB->getInfoTable();

        $array = array();

        foreach ($infoTable as $attributes) {
            foreach ($attributes as $attribute) {
                $get = "get" . $objectDB->nameMethodAssessor($attribute);
                $array [$attribute] = $objectDB->$get();
            }
        }

        $array = Seguranca::stripslashes($array);

        return $array;
    }

}

?>