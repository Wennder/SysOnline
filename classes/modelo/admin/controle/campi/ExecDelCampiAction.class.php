<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/campi/GestaoCampi.class.php';
require_once 'classes/modelo/admin/entidade/campi/DAOCampus.class.php';
require_once 'classes/modelo/admin/entidade/campi/Campus.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';

class ExecDelCampiAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCampi::validateRequestDel($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $idCampi = $cleanRequest->get("idCampi");
            $idCampi = (count($idCampi) > 0) ? $idCampi : array();

            try {
                $dao = new DAOCampus ( );
                $campus = new Campus();

                foreach ($idCampi as $id) {
                    $campus->setIdCampus($id);
                    $dao->load($campus);
                    $dao->delete($campus);
                }
                $msg = "Campus(s) deletado(s) com sucesso.";
                $response->addScript("js.promptMenssage('Exclusão de Campus','{$msg}',false)");
                $response->addScript("GestaoCampi.initList()");
            } catch (Exception $e) {
                $response->addAlert(Util::debugVar($e));
                $msg = "Falha ao excluir alguns campi. Recomece do Inicio.";
                $response->addScript("js.promptMenssage('Exclusão de Campus','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informações necessárias para excluir campus não foram informadas corretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Exclusão de Campus','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>