<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';

class MudaStatusFuncionarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoFuncionarios::validateRequestMudaStatus($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $id = $cleanRequest->get("idFuncionario");
            $status = $cleanRequest->get("status");
            $result = GestaoFuncionarios::mudaStatus($id, $status);
            if ($result ['ok']) {
                $response->addScript("GestaoFuncionarios.refreshLinkStatus({$id}, {$status})");
            } else {
                $msg = "Falha ao alterar o status deste funcion�rio.";
                $response->addScript("js.promptMenssage('Mudan�a de Status dos Funcion�rios','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informa��es necess�rias para alterar este status n�o foram informadas corretamente.";
            $response->addScript("js.promptMenssage('Mudan�a de Status dos Funcion�rios','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>
