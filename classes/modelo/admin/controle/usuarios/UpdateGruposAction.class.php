<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOGrupo.class.php';

class UpdateGruposAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoUsuarios::validateRequestPermissoes($rawRequest, "grupos");

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $idUsuario = $cleanRequest->get("idUsuario");
            $grupos = $cleanRequest->get("grupos");

            try {
                DAOGrupo::updateGrupos($idUsuario, $grupos);
                $response->addScript("js.promptMenssage('Permiss�es de Usu�rios','Atualiza��o conclu�da com sucesso',false)");
            } catch (Exception $e) {
                $response->addScript("js.promptMenssage('Permiss�es de Usu�rios','Falha ao atualizar os grupos para este usu�rio. Tente mais tarde',true)");
            }
        } else {
            $msg = $controlValidation->getErrosAsString();
            $response->addScript("js.promptMenssage('Permiss�es de Usu�rios','{$msg}',true)");
        }

        $this->setResponse($response);
    }
}

?>