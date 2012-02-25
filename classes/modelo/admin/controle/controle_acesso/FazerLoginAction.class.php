<?php

require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/base/controle/validacao/ValidationFacade.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
require_once 'classes/base/controle/validacao/LoginValidator.class.php';
require_once 'classes/base/controle/validacao/SenhaValidator.class.php';
require_once 'classes/base/controle/validacao/NoValidator.class.php';

class FazerLoginAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();
        $rawRequest = $this->getRequest();

        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new LoginValidator("login", "Este login щ invсlido"));
        $controlValidation->addValidator(new SenhaValidator("senha", "Esta senha щ invсlida"));
        $controlValidation->addValidator(new NoValidator("lembrar"));

        $controlValidation->validate($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $lembrar = false;
            if ($cleanRequest->get('lembrar') == "1") {
                $lembrar = true;
            }

            $resultado = ControleAcesso::entrarSistema($cleanRequest->get('login'), $cleanRequest->get('senha'), $lembrar);

            switch ($resultado) {
                case ControleAcesso::ENTRADA_OK:
                    $response->addRedirect("admin.php");
                    //$response->addScript ( "ControleAcesso.iniIndex()" );
                    break;
                case ControleAcesso::SEM_FLUXOS:
                    $response->addScript("js.promptMenssage('Controle de Acesso','Vocъ foi autenticado mas nуo lhe foi dado nenhum privilщgio dentro do sistema. Entre em contato com o administrador.',true)");
                    break;
                case ControleAcesso::LOGIN_ERRO:
                    $response->addScript("js.promptMenssage('Controle de Acesso','Acoteceu um erro inesperado durante a autenticaчуo. Tente novamente mais tarde.',true)");
                    break;
                default:
                    $response->addScript("js.promptMenssage('Controle de Acesso','Acoteceu um erro inesperado durante a autenticaчуo. Tente novamente mais tarde.',true)");
                    break;
            }
        } else {
            $response->addScript("js.promptMenssage('Controle de Acesso','Vocъ nуo foi autenticado.',true)");
        }

        $this->setResponse($response);
    }

}

?>