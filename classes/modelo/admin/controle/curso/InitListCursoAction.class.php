<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/curso/TelaListCurso.class.php';

class InitListCursoAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaListCurso();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Listagem de Curso - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Listagem de Curso");
        $response->addScript("FormUtil.initForm('formListCurso')");
        $response->addScript("GestaoCurso.execList()");

        $this->setResponse($response);
    }
}

?>