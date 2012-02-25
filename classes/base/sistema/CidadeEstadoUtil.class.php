<?php

require_once 'classes/base/controle/validacao/NoValidator.class.php';
require_once 'classes/base/controle/validacao/StringNotEmptyValidator.class.php';
require_once 'classes/base/controle/validacao/InteiroPositivoValidator.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/controle/validacao/ValidationFacade.class.php';

class CidadeEstadoUtil {

    public function validateRequest($rawRequest) {
        $controlValidation = new ValidationFacade ( );

        $controlValidation->addValidator(new NoValidator("idUf", "Falta informar o estado."));
        $controlValidation->addValidator(new StringNotEmptyValidator("idSelect", "Falta informar o select das cidades"));
        $controlValidation->addValidator(new StringNotEmptyValidator("arrayName", "Falta informar o nome do array."));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    function getMapCidade($idUf) {
        $sql = "select tbcidade.idCidade, tbcidade.nome from tbcidade where tbcidade.idUf='{$idUf}' order by nome asc";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();
        $dbResult = $dbConn->query($sql);
        $itens = $dbResult->getAllResult();

        $array = array();

        if (count($itens) > 0) {
            foreach ($itens as $tmp) {
                $array [$tmp ['idCidade']] = $tmp ['nome'];
            }
        }

        return $array;
    }

    function getMapUf($value = "idUf") {
        $sql = "select tbuf.{$value}, tbuf.nome from tbuf order by nome asc";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();
        $dbResult = $dbConn->query($sql);
        $itens = $dbResult->getAllResult();

        $array = array();

        foreach ($itens as $tmp) {
            $array [$tmp [$value]] = $tmp ['nome'];
        }

        return $array;
    }

    function getInfoCidadeEstado($idCidade) {
        $sql = "select tbcidade.idCidade, tbcidade.idUf, tbcidade.nome as nomeCidade, tbuf.nome as nomeUf, tbuf.sigla from tbcidade
		inner join tbuf on tbcidade.idUf = tbuf.idUf
		where idCidade='{$idCidade}'";

        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();
        $dbResult = $dbConn->query($sql);

        return $dbResult->getOneResult();
    }

}

?>
