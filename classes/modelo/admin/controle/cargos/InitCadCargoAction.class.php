<?php

require_once 'classes/modelo/admin/interface/cargos/TelaCadCargo.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

class InitCadCargoAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaCadCargo();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Cadastro de Cargo - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Cadastro de Cargo");
        $response->addScript("FormUtil.initForm('formSaveCargo')");

        $this->setResponse($response);
    }

}

?>