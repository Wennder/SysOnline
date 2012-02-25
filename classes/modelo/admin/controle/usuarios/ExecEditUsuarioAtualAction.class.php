<?php

require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
require_once 'classes/modelo/admin/controle/usuarios/ExecEditUsuarioAction.class.php';

class ExecEditUsuarioAtualAction extends ExecEditUsuarioAction {

    public function execute() {
        $this->acaoPosAlt = '';

        $rawRequest = $this->getRequest();

        $data = $rawRequest->getData();

        $data ['idUsuario'] = ControleAcesso::getIdUsuarioOnline ();

        $rawRequest->setData($data);

        $this->setRequest($rawRequest);

        parent::execute ();
    }
}

?>