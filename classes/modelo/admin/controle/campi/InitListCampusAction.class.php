<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/campi/TelaListCampi.class.php';

class InitListCampusAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaListCampi();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Listagem de Campi - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Listagem de Campi");
        $response->addScript("FormUtil.initForm('formListCampus')");
        $response->addScript("GestaoCampi.execList()");

        $this->setResponse($response);
    }

}

?>