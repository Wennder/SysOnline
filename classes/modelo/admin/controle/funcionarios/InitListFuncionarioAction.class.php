<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/funcionarios/TelaListFuncionarios.class.php';

class InitListFuncionarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaListFuncionarios();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Listagem de Funcionários - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Listagem de Funcionários");
        $response->addScript("FormUtil.initForm('formListFuncionario')");
        $response->addScript("GestaoFuncionarios.execList()");

        $this->setResponse($response);
    }

}

?>