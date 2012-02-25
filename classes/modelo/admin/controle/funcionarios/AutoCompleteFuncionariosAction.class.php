<?php

require_once 'classes/modelo/admin/entidade/funcionarios/DAOFuncionario.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';
require_once 'classes/base/controle/AjaxTextResponse.class.php';

class AutoCompleteFuncionariosAction extends AbstractAction {

    public function execute() {
        $response = new AjaxTextResponse ( );

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoFuncionarios::validateReqCompFuncionario($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $lista = DAOFuncionario::getMapAutoComplete($cleanRequest->get('q'));

            if (count($lista) > 0) {
                foreach ($lista as $id => $nome) {
                    $response->addTxt("({$nome['matricula']}) {$nome['nome']}|{$nome['idFuncionario']}");
                }
            }
        }

        $this->setResponse($response);
    }
}

?>
