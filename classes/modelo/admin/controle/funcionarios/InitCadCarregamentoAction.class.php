<?php

require_once 'classes/modelo/admin/interface/funcionarios/TelaCadCarregarFuncionario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

class InitCadCarregamentoAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaCadCarregarFuncionario();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Carregar Funcionários - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Carregar Funcionários");

        $this->setResponse($response);
    }

}

?>