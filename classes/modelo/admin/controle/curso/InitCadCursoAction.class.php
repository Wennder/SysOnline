<?php

require_once 'classes/modelo/admin/interface/curso/TelaCadCurso.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

class InitCadCursoAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaCadCurso();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Cadastro de Curso - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Cadastro de Curso");
        $response->addScript("FormUtil.initForm('formSaveCurso')");

        $this->setResponse($response);
    }

}

?>