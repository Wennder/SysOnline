<?php

require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/controle/cargos/GestaoCargos.class.php';
require_once 'classes/modelo/admin/entidade/cargos/Cargo.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/cargos/DAOCargo.class.php';

class ExecEditCargoAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCargos::validateRequestCad($rawRequest, true);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $cargo = new Cargo();

            $cargo->setIdCargo($cleanRequest->get('idCargo'));
            $cargo->setNome($cleanRequest->get('nome'));

            try {
                $daoCargo = new DAOCargo();

                $daoCargo->update($cargo);

                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $msg = "Alteraзгo concluнda com sucesso.";
                $response->addScript("js.promptMenssage('Alteraзгo de Cargos','{$msg}',false)");
                $response->addScript("GestaoCargos.initList()");
            } catch (Exception $e) {
                $msg = "A alteraзгo deste cargo nгo pфde ser concluнda. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Alteraзгo de Cargos','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>