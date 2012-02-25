<?php

require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';
require_once 'classes/modelo/admin/entidade/funcionarios/Funcionario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/funcionarios/DAOFuncionario.class.php';

class ExecEditFuncionarioAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoFuncionarios::validateRequestCad($rawRequest, true);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $funcionario = new Funcionario();

            $funcionario->setIdFuncionario($cleanRequest->get('idFuncionario'));
            $funcionario->setNome($cleanRequest->get('nome'));
            $funcionario->setCpf($cleanRequest->get('cpf'));
            $funcionario->setMatricula($cleanRequest->get('matricula'));
            $funcionario->setRg($cleanRequest->get('rg'));
            $funcionario->setPis($cleanRequest->get('pis'));
            $funcionario->setIdCampus($cleanRequest->get('campus'));
            $funcionario->setIdCargo($cleanRequest->get('cargo'));

            try {
                $daoFuncionario = new DAOFuncionario();
                $daoFuncionario->update($funcionario);

                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $msg = "Alteraзгo concluнda com sucesso.";
                $response->addScript("js.promptMenssage('Alteraзгo de Funcionбrios','{$msg}',false)");
                $response->addScript("GestaoFuncionarios.initList()");
            } catch (Exception $e) {
                $msg = "A alteraзгo deste funcionбrio nгo pфde ser concluнda. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Alteraзгo de Funcionбrios','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>