<?php

require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/controle/campi/GestaoCampi.class.php';
require_once 'classes/modelo/admin/entidade/campi/Campus.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/campi/DAOCampus.class.php';

class ExecEditCampusAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCampi::validateRequestCad($rawRequest, true);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $campus = new Campus();

            $campus->setIdCampus($cleanRequest->get('idCampus'));
            $campus->setNome($cleanRequest->get('nome'));

            try {
                $daoCampus = new DAOCampus();
                $daoCampus->update($campus);

                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $msg = "Altera��o conclu�da com sucesso.";
                $response->addScript("js.promptMenssage('Altera��o de Campus','{$msg}',false)");
                $response->addScript("GestaoCampi.initList()");
            } catch (Exception $e) {
                $msg = "A altera��o deste campus n�o p�de ser conclu�da. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Altera��o de Campus','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>