<?php

require_once 'classes/base/controle/validacao/InteiroPositivoValidator.class.php';
require_once 'classes/base/controle/validacao/NoValidator.class.php';
require_once 'classes/base/controle/validacao/ArrayValidator.class.php';
require_once 'classes/base/sistema/ListagemUtil.class.php';
require_once 'classes/base/controle/validacao/StringNotEmptyValidator.class.php';
require_once 'classes/base/controle/validacao/ValidationFacade.class.php';
require_once 'classes/modelo/admin/entidade/cargos/DAOCargo.class.php';
require_once 'classes/modelo/admin/entidade/campi/DAOCampus.class.php';
require_once 'classes/modelo/admin/entidade/funcionarios/DAOFuncionario.class.php';

class GestaoFuncionarios {
    const NUM_ITENS = 10;

    public function getCamposOrdemLista($formatMap = FALSE) {
        
        $map ['0'] ['label'] = "Nome";
        $map ['0'] ['campo'] = "tbfuncionario.nome";
        $map ['1'] ['label'] = "CPF";
        $map ['1'] ['campo'] = "tbfuncionario.cpf";
        $map ['2'] ['label'] = "Matricula";
        $map ['2'] ['campo'] = "tbfuncionario.matricula";
        $map ['3'] ['label'] = "RG";
        $map ['3'] ['campo'] = "tbfuncionario.rg";
        $map ['4'] ['label'] = "Cargo";
        $map ['4'] ['campo'] = "tbcargo.nome";
        $map ['5'] ['label'] = "Campus";
        $map ['5'] ['campo'] = "tbcampus.nome";
        $map ['6'] ['label'] = "Pis";
        $map ['6'] ['campo'] = "tbcampus.pis";

        $result = $map;

        if ($formatMap) {
            $result = ListagemUtil::formatMapLista($map);
        }

        return $result;
    }

    private function getCampoOrdem($indice) {
        $map = self::getCamposOrdemLista();

        return $map [$indice] ['campo'];
    }

    public static function validateRequestCad($rawRequest, $edit = false) {
        $controlValidation = new ValidationFacade();

        if ($edit) {

            $controlValidation->addValidator(new InteiroPositivoValidator("idFuncionario", "Falta informar o funcionário que será alterado."));
        }

        $controlValidation->addValidator(new StringNotEmptyValidator("nome", "O NOME deve ser informado."));
        $controlValidation->addValidator(new StringNotEmptyValidator("matricula", "O MATRÍCULA deve ser informada."));
        $controlValidation->addValidator(new StringNotEmptyValidator("cpf", "O CPF deve ser informado."));
        $controlValidation->addValidator(new StringNotEmptyValidator("rg", "O RG deve ser informado."));
        $controlValidation->addValidator(new StringNotEmptyValidator("pis", "O PIS deve ser informado."));
        $controlValidation->addValidator(new InteiroPositivoValidator("cargo", "O CARGO não pode ser vazio."));
        $controlValidation->addValidator(new InteiroPositivoValidator("campus", "O CAMPUS não pode ser vazio."));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestList($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new StringNotEmptyValidator("ACTION", ""));
        $controlValidation->addValidator(new NoValidator("funcionario", ""));
        $controlValidation->addValidator(new NoValidator("ordem", ""));
        $controlValidation->addValidator(new NoValidator("sentido", ""));
        $controlValidation->addValidator(new NoValidator("cargo", ""));
        $controlValidation->addValidator(new NoValidator("campi", ""));
        $controlValidation->addValidator(new NoValidator("pag", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestID($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new InteiroPositivoValidator("idFuncionario", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestDel($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new ArrayValidator("idFuncionarios", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestMudaStatus($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new NoValidator("idFuncionario", ""));
        $controlValidation->addValidator(new NoValidator("status", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestInitAlt($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new InteiroPositivoValidator("idFuncionario", ""));
        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateReqCompFuncionario($rawRequest) {
        $controlValidation = new ValidationFacade ( );

        $controlValidation->addValidator(new StringNotEmptyValidator("q", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function getMapCargo() {
        return DAOCargo::getMap ();
    }

    public static function getMapCampus() {
        return DAOCampus::getMap ();
    }

    public static function mudaStatus($idFuncionario, $status) {
        if ($status == 1) {
            $novoStatus = 0;
        } else {
            $novoStatus = 1;
        }

        $dao = new DAOFuncionario();
        $result ['ok'] = $dao->mudaStatus($idFuncionario, $novoStatus);
        $result ['status'] = $novoStatus;

        return $result;
    }

    public static function deleteFunc($idFuncionario) {
        $dao = new DAOFuncionario();
        return $dao->deleteFunc($idFuncionario);
    }

    public static function filtroBasico($params) {
        $nome = (isset($params ['funcionario'])) ? ($params ['funcionario']) : ("");
        $cargo = (isset($params ['cargo'])) ? ($params ['cargo']) : ("");
        $campi = (isset($params ['campi'])) ? ($params ['campi']) : ("");
        $ordem = ($params ['ordem'] == null) ? (0) : ($params ['ordem']);
        $sentido = (isset($params ['sentido'])) ? ($params ['sentido']) : (ListagemUtil::lISTA_DESC);
        $li = (isset($params ['li'])) ? ($params ['li']) : (0);
        $numItens = (isset($params ['numItens'])) ? ($params ['numItens']) : (self::NUM_ITENS);

        unset($params);

        $strWhere = "1=1";
        $strWhere .= ( !empty($nome)) ? (" and ((tbfuncionario.nome like '%{$nome}%') or (tbfuncionario.cpf like '%{$nome}%') or (tbfuncionario.matricula like '%{$nome}%') or (tbfuncionario.rg like '%{$nome}%') or (tbfuncionario.pis like '%{$nome}%'))") : ("");
        $strWhere .= ( !empty($cargo)) ? ("  and ((tbcargo.idCargo = {$cargo}))") : ("");
        $strWhere .= ( !empty($campi)) ? ("  and ((tbcampus.idCampus = {$campi}))") : ("");
        $strWhere .= " and (tbfuncionario.status != -1)";

        if ($li < 0) {
            $li = 0;
        }
        if ($numItens <= 0) {
            $numItens = 10;
        }

        $campoOrdem = ListagemUtil::getCampoOrdem($ordem, self::getCamposOrdemLista ());
        $sentidoOrdem = ($sentido == ListagemUtil::LISTA_ASC) ? ("asc") : ("desc");

        $filtro ['tabelas'] = "tbfuncionario";
        $filtro ['campos'] = "tbfuncionario.*, tbcampus.nome as campus, tbcargo.nome as cargo";
        $filtro ['join'] = "inner join tbcargo on tbcargo.idCargo = tbfuncionario.idCargo
			    inner join tbcampus on tbcampus.idCampus = tbfuncionario.idCampus";
        $filtro ['group'] = "";
        $filtro ['condicao'] = $strWhere;
        $filtro ['ordem'] = "order by {$campoOrdem} {$sentidoOrdem}";
        $filtro ['li'] = $li;
        $filtro ['numItens'] = $numItens;

        return $filtro;
    }

    public static function getCamposCargo() {
        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $sql = "SELECT idCargo,nome from tbcargo";

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            $itens = $dbResult->getAllResult();
            $result = array();

            foreach ($itens as $tmp) {
                $result [$tmp ['idCargo']] = $tmp ['nome'];
            }

            return $result;
        } else {
            return array();
        }
    }

    public static function getCamposCampi() {
        $dbConn = DatabaseConnectionFactory::getDefaultConnection ();

        $sql = "SELECT idCampus,nome from tbcampus";

        $dbResult = $dbConn->query($sql);

        if ($dbResult->rowCount() > 0) {
            $itens = $dbResult->getAllResult();
            $result = array();

            foreach ($itens as $tmp) {
                $result [$tmp ['idCampus']] = $tmp ['nome'];
            }

            return $result;
        } else {
            return array();
        }
    }

}

?>
