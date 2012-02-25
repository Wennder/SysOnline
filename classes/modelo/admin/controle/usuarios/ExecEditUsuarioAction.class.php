<?php

require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/Usuario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOUsuario.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/UsuarioInfo.class.php';

class ExecEditUsuarioAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoUsuarios::validateRequestAlt($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $senha = $cleanRequest->get('senha');

            $usuario = new Usuario();
            $usuarioInfo = new UsuarioInfo();

            $usuario->setIdUsuario($cleanRequest->get('idUsuario'));
            $usuario->setLogin($cleanRequest->get('login'));

            if (!empty($senha)) {
                $usuario->setSenha($senha);
            }

            $usuarioInfo->setIdUsuario($cleanRequest->get('idUsuario'));
            $usuarioInfo->setNome($cleanRequest->get('nome'));
            $usuarioInfo->setEmail($cleanRequest->get('email'));

            $daoUsuario = new DAOUsuario();
            $daoInfo = new DAOObjectDB();

            try {
                $dbConn = $daoUsuario->getDbConn();
                $dbConn->beginTrans();

                $daoUsuario->update($usuario);
                $daoInfo->update($usuarioInfo);

                $dbConn->commitTrans();

                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $msg = "Alteraзгo concluнda com sucesso.";
                $response->addScript("js.promptMenssage('Alteraзгo de Usuбrios','{$msg}',false)");
                $response->addScript("GestaoUsuarios.initList()");
            } catch (Exception $e) {
                $dbConn->rollBackTrans();
                $msg = "A alteraзгo deste usuбrio nгo pфde ser concluнda. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Alteraзгo de Usuбrios','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }
}

?>