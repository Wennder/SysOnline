<?php

require_once 'classes/modelo/admin/controle/campi/GestaoCampi.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/entidade/campi/DAOCampus.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/campi/Campus.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';

class ExecCadCampusAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCampi::validateRequestCad($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $campus = new Campus();

            $campus->setNome($cleanRequest->get('nome'));

            $daoCampus = new DAOCampus();

            try {
                $dbConn = $daoCampus->getDbConn();
                $dbConn->beginTrans();

                $daoCampus->save($campus);

                $dbConn->commitTrans();

                $msg = "Cadastro concluído com sucesso.";
                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $response->addScript("js.promptMenssage('Cadastro de Campi','{$msg}',false)");
                $response->addScript("GestaoCampi.initList()");
            } catch (Exception $e) {
                $dbConn->rollBackTrans();
                $msg = "O cadastro deste campus não pôde ser concluído. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Cadastro de Campi','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>