<?php

require_once 'classes/modelo/admin/interface/usuarios/TelaCadUsuario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

class InitCadUsuarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $tela = new TelaCadUsuario();
        $tela->processAssign();

        $response->addAssign("tela", "innerHTML", $tela->getHTML());
        $response->addScript("js.changeTitle('Cadastro de Usuário - SysAudi')");
        $response->addAssign("tituloTela", "innerHTML", "Cadastro de Usuário");
        $response->addScript("FormUtil.initForm('formSaveUsuario')");

        $this->setResponse($response);
    }
}

?>