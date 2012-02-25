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
                $msg = "Funcion�rio(s) deletado(s) com sucesso.";
                $response->addScript("js.promptMenssage('Exclus�o de Funcion�rios','{$msg}',false)");
                $response->addScript("GestaoFuncionarios.initList()");
            } catch (Exception $e) {
                $msg = "Falha ao excluir alguns funcion�rios. Recomece do Inicio.";
                $response->addScript("js.promptMenssage('Exclus�o de Funcion�rios','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informa��es necess�rias para excluir funcion�rios n�o foram informadas corretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Exclus�o de Funcion�rios','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>