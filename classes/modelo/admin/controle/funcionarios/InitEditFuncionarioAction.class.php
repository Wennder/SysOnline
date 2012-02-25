<?php

require_once 'classes/modelo/admin/entidade/funcionarios/Funcionario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/funcionarios/TelaCadFuncionario.class.php';
require_once 'classes/modelo/admin/entidade/funcionarios/DAOFuncionario.class.php';

class InitEditFuncionarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoFuncionarios::validateRequestInitAlt($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $idFuncionario = $cleanRequest->get("idFuncionario");

            $dao = new DAOFuncionario();
            $funcionario = new Funcionario();

            $funcionario->setIdFuncionario($idFuncionario);

            $dao->load($funcionario);

            if ($funcionario->isLoaded()) {
                $tela = new TelaCadFuncionario();
                $tela->setDados($dao->toArray($funcionario));
                $tela->processAssign();

                $response->addAssign("tela", "innerHTML", $tela->getHTML());
                $response->addScript("js.changeTitle('Edi��o de Funcion�rio - SysAudi')");
                $response->addAssign("tituloTela", "innerHTML", "Edi��o de Funcion�rio");
                $response->addScript("FormUtil.initForm('formSaveFuncionario')");
            } else {
                $msg = "O funcion�rio informado para altera��o n�o foi encontrado. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Altera��o de Funcionarios','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informa��es necess�rias para alterar um funcion�rio foram informadas incorretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Altera��o de Funcionarios','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>