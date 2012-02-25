<?php

require_once 'classes/modelo/admin/entidade/usuarios/Usuario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/usuarios/TelaCadUsuario.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOUsuario.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/UsuarioInfo.class.php';

class InitEditUsuarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoUsuarios::validateRequestInitAlt($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $idUsuario = $cleanRequest->get("idUsuario");

            $dao = new DAOUsuario();
            $usuario = new Usuario();
            $usuarioInfo = new UsuarioInfo();

            $usuario->setIdUsuario($idUsuario);
            $usuarioInfo->setIdUsuario($idUsuario);

            $dao->load($usuario);

            if ($usuario->isLoaded()) {
                $dao->load($usuarioInfo);

                $tela = new TelaCadUsuario();
                $tela->setDados($dao->toArray($usuario), $dao->toArray($usuarioInfo));
                $tela->processAssign();

                $response->addAssign("tela", "innerHTML", $tela->getHTML());
                $response->addScript("js.changeTitle('Ediчуo de Usuсrio - SysAudi')");
                $response->addAssign("tituloTela", "innerHTML", "Ediчуo de Usuсrio");
                $response->addScript("FormUtil.initForm('formSaveUsuario')");
            } else {
                $response->addScript("TelaPrincipal.showMsgAlerta({titulo:'Alteraчуo de Usuсrios', texto:'O usuсrio informado para alteraчуo nуo foi encontrado. Recomece do inicio'})");
            }
        } else {
            $response->addScript("TelaPrincipal.showMsgAlerta({titulo:'Alteraчуo de Usuсrios', texto:'Algumas informaчѕes necessсrias para alterar um usuсrio foram informadas incorretamente. Recomece do inicio.'})");
        }

        $this->setResponse($response);
    }
}

?>