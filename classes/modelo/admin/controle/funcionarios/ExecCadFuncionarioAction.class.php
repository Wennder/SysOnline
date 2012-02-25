<?php

require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/entidade/funcionarios/DAOFuncionario.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/funcionarios/Funcionario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';

class ExecCadFuncionarioAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoFuncionarios::validateRequestCad($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $funcionario = new Funcionario();

            $funcionario->setNome($cleanRequest->get('nome'));
            $funcionario->setCpf($cleanRequest->get('cpf'));
            $funcionario->setMatricula($cleanRequest->get('matricula'));
            $funcionario->setRg($cleanRequest->get('rg'));
            $funcionario->setPis($cleanRequest->get('pis'));
            $funcionario->setIdCampus($cleanRequest->get('campus'));
            $funcionario->setIdCargo($cleanRequest->get('cargo'));

            $daoFuncionario = new DAOFuncionario();

            try {
                $dbConn = $daoFuncionario->getDbConn();
                $dbConn->beginTrans();

                $daoFuncionario->save($funcionario);

                $dbConn->commitTrans();

                $msg = "Cadastro concluído com sucesso.";
                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $response->addScript("js.promptMenssage('Cadastro de Funcionários','{$msg}',false)");
                $response->addScript("GestaoFuncionarios.initList()");
            } catch (Exception $e) {
                $dbConn->rollBackTrans();
                $msg = "O cadastro deste funcionário não pôde ser concluído. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Cadastro de Funcionários','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>