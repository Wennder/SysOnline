<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/cargos/TelaListCargos.class.php';

class InitListCargoAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaListCargos();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Listagem de Cargos - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Listagem de Cargos");
        $response->addScript("FormUtil.initForm('formListCargo')");
        $response->addScript("GestaoCargos.execList()");

        $this->setResponse($response);
    }
}

?>