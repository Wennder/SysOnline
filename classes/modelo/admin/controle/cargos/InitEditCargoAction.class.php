<?php

require_once 'classes/modelo/admin/entidade/cargos/Cargo.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/cargos/GestaoCargos.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/cargos/TelaCadCargo.class.php';
require_once 'classes/modelo/admin/entidade/cargos/DAOCargo.class.php';

class InitEditCargoAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCargos::validateRequestInitAlt($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $idCargo = $cleanRequest->get("idCargo");

            $dao = new DAOCargo();
            $cargo = new Cargo();

            $cargo->setIdCargo($idCargo);

            $dao->load($cargo);

            if ($cargo->isLoaded()) {
                $tela = new TelaCadCargo();
                $tela->setDados($dao->toArray($cargo));
                $tela->processAssign();

                $response->addAssign("tela", "innerHTML", $tela->getHTML());
                $response->addScript("js.changeTitle('Edi��o de Cargo - SysAudi')");
                $response->addAssign("tituloTela", "innerHTML", "Edi��o de Cargo");
                $response->addScript("FormUtil.initForm('formSaveCargo')");
            } else {
                $msg = "O cargo informado para altera��o n�o foi encontrado. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Altera��o de Cargos','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informa��es necess�rias para alterar um cargo foram informadas incorretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Altera��o de Cargos','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>