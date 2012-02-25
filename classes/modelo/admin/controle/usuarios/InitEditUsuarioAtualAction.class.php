<?php

require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
require_once 'classes/modelo/admin/controle/usuarios/InitEditUsuarioAction.class.php';

class InitEditUsuarioAtualAction extends InitEditUsuarioAction {

    public function execute() {
        $this->paramsTela ['editUsuarioAtual'] = TRUE;

        $rawRequest = $this->getRequest();

        $data = $rawRequest->getData();

        $data ['idUsuario'] = ControleAcesso::getIdUsuarioOnline ();

        $rawRequest->setData($data);

        $this->setRequest($rawRequest);

        parent::execute ();
    }
}

?>