<?php

require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';

class DAOGrupo extends DAOObjectDB {

    public static function loadGrupos($idUsuario = null) {
        $idUsuario = intval($idUsuario);
        $strCond = "";

        if ($idUsuario > 0) {
            $strCond = "and stbgrupo_stbusuario.idUsuario = '{$idUsuario}'";
        }

        $sql = "select stbgrupo.*, stbgrupo_stbusuario.idUsuario
                from stbgrupo
                left outer join stbgrupo_stbusuario on stbgrupo_stbusuario.idGrupo = stbgrupo.idGrupo {$strCond}
                order by stbgrupo.nome asc";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection();

        $dbResult = $dbConn->query($sql);

        $itens = $dbResult->getAllResult();

        $resut = array();

        for ($i = 0; $i < count($itens); $i++) {
            $resut [$itens [$i] ['idGrupo']] = $itens [$i];
        }

        unset($itens);

        return $resut;
    }

    public static function loadGruposUsuario($idUsuario) {
        $idUsuario = intval($idUsuario);

        $sql = "select stbgrupo.*, stbgrupo_stbusuario.idUsuario as permissao
                from stbgrupo
                left outer join stbgrupo_stbusuario on stbgrupo_stbusuario.idGrupo = stbgrupo.idGrupo
                        and stbgrupo_stbusuario.idUsuario = '{$idUsuario}'
                order by stbgrupo.nome asc";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection();

        $dbResult = $dbConn->query($sql);

        return $dbResult->getAllResult();
    }

    public static function updateGrupos($idUsuario, $grupo) {
        self::clearGrupos($idUsuario);

        $value = "({$idUsuario}, $grupo)";

        $sql = "insert into stbgrupo_stbusuario (idUsuario, idGrupo) values {$value}";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection();

        $dbConn->query($sql);
    }

    private function clearGrupos($idUsuario) {

        $sql = "delete from stbgrupo_stbusuario where idUsuario = '{$idUsuario}'";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection();

        $dbConn->query($sql);
    }

    private static function loadFluxos($listaGrupos) {
        $strGrupos = "('" . implode("', '", $listaGrupos) . "')";

        $sql = "select stbfluxo.idFluxo
                from stbfluxo
                inner join stbcaso_de_uso on stbfluxo.idCasoDeUso = stbcaso_de_uso.idCasoDeUso
                inner join stbgrupo_stbcaso_de_uso on stbgrupo_stbcaso_de_uso.idCasoDeUso = stbcaso_de_uso.idCasoDeUso
                        and stbgrupo_stbcaso_de_uso.idGrupo in {$strGrupos}";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection();

        $dbResult = $dbConn->query($sql);

        $itens = $dbResult->getAllResult();

        return $itens;
    }

    public function addFluxos($idUsuario, $listaGrupos) {
        $fluxos = self::loadFluxos($listaGrupos);

        foreach ($fluxos as $fluxo) {
            try {
                $sql = "insert into stbusuario_stbfluxo (idUsuario, idFluxo) values ({$idUsuario}, {$fluxo['idFluxo']})";

                $dbConn = DatabaseConnectionFactory::getDefaultConnection();

                $dbConn->query($sql);
            } catch (Exception $e) {
                //@todo tratar essa exceção?
            }
        }
    }

    public static function verificaPermissionGeneric($idFluxo, $idUsuarioLogado) {

        $sql = "SELECT * FROM stbusuario_stbfluxo WHERE idUsuario = {$idUsuarioLogado} AND idFluxo = {$idFluxo}";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>
