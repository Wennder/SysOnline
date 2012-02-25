<?php

require_once 'classes/modelo/admin/interface/funcionarios/TelaCadFuncionario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

class InitCadFuncionarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaCadFuncionario();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Cadastro de Funcion�rio - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Cadastro de Funcion�rio");
        $response->addScript("FormUtil.initForm('formSaveFuncionario')");

        $this->setResponse($response);
    }

}

?>