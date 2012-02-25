<?php

require_once 'classes/modelo/admin/interface/campi/TelaCadCampus.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

class InitCadCampusAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaCadCampus();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Cadastro de Campus - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Cadastro de Campus");
        $response->addScript("FormUtil.initForm('formSaveCampus')");

        $this->setResponse($response);
    }

}

?>