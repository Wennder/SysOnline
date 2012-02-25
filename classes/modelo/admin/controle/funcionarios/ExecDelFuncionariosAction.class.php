<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';

class ExecDelFuncionariosAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoFuncionarios::validateRequestDel($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $idFuncionarios = $cleanRequest->get("idFuncionarios");
            $idFuncionarios = (count($idFuncionarios) > 0) ? $idFuncionarios : array();

            try {
                foreach ($idFuncionarios as $id) {
                    GestaoFuncionarios::deleteFunc($id);
                }
                $msg = "Funcionário(s) deletado(s) com sucesso.";
                $response->addScript("js.promptMenssage('Exclusão de Funcionários','{$msg}',false)");
                $response->addScript("GestaoFuncionarios.initList()");
            } catch (Exception $e) {
                $msg = "Falha ao excluir alguns funcionários. Recomece do Inicio.";
                $response->addScript("js.promptMenssage('Exclusão de Funcionários','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informações necessárias para excluir funcionários não foram informadas corretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Exclusão de Funcionários','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>