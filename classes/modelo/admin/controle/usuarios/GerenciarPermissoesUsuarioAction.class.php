<?php

require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/UsuarioInfo.class.php';
require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';
require_once 'classes/modelo/admin/interface/usuarios/TelaPermissoesUsuario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

class GerenciarPermissoesUsuarioAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse ( );

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoUsuarios::validateRequestID($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $usuario = new UsuarioInfo ( );
            $usuario->setIdUsuario($cleanRequest->get('idUsuario'));
            $dao = new DAOObjectDB ( );
            $dao->load($usuario);

            $tela = new TelaPermissoesUsuario ( );
            $tela->setIdUsuario($cleanRequest->get('idUsuario'));
            $tela->assign("usuarioInfo", $dao->toArray($usuario));
            $tela->processAssign();

            $response->addAssign("tela", "innerHTML", $tela->getHTML());
        } else {
            $response->addScript("js.promptMenssage('Gerenciamento de Permissões','Algumas informações necessárias para gerenciar as permissões não foram inforamdas corretamente. Recomece do inicio',true)");
        }

        $this->setResponse($response);
    }
}

?>