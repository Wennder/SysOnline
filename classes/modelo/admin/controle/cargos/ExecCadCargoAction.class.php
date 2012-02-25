<?php

require_once 'classes/modelo/admin/controle/cargos/GestaoCargos.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/entidade/cargos/DAOCargo.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/cargos/Cargo.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';

class ExecCadCargoAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCargos::validateRequestCad($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $cargo = new Cargo();

            $cargo->setNome($cleanRequest->get('nome'));

            $daoCargo = new DAOCargo();

            try {
                $dbConn = $daoCargo->getDbConn();
                $dbConn->beginTrans();

                $daoCargo->save($cargo);

                $dbConn->commitTrans();

                $msg = "Cadastro concluído com sucesso.";
                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $response->addScript("js.promptMenssage('Cadastro de Cargos','{$msg}',false)");
                $response->addScript("GestaoCargos.initList()");
            } catch (Exception $e) {
                $response->addAlert(Util::debugVar($e));
                $dbConn->rollBackTrans();
                $msg = "O cadastro deste cargos não pôde ser concluído. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Cadastro de Cargos','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>