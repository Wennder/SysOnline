<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';

class MudaStatusUsuarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoUsuarios::validateRequestMudaStatus($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $id = $cleanRequest->get("idUsuario");
            $status = $cleanRequest->get("status");
            $result = GestaoUsuarios::mudaStatus($id, $status);
            if ($result ['ok']) {
                $response->addScript("GestaoUsuarios.refreshLinkStatus({$id}, {$status})");
            } else {
                $msg = "Falha ao alterar o status deste usuários.";
                $response->addScript("TelaPrincipal.showMsgAlerta({titulo:'Mudança de Status dos Usuários', texto:'{$msg}'})");
            }
        } else {
            $msg = "Algumas informações necessárias para alterar este status não foram informadas corretamente.";
            $response->addScript("TelaPrincipal.showMsgAlerta({titulo:'Mudança de Status dos Usuários', texto:'{$msg}'})");
        }

        $this->setResponse($response);
    }
}

?>
