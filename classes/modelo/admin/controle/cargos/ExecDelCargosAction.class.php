<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/cargos/GestaoCargos.class.php';
require_once 'classes/modelo/admin/entidade/cargos/DAOCargo.class.php';
require_once 'classes/modelo/admin/entidade/cargos/Cargo.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';

class ExecDelCargosAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCargos::validateRequestDel($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $idCargos = $cleanRequest->get("idCargos");
            $idCargos = (count($idCargos) > 0) ? $idCargos : array();

            try {
                $dao = new DAOCargo ( );
                $cargo = new Cargo();

                foreach ($idCargos as $id) {
                    $cargo->setIdCargo($id);
                    $dao->load($cargo);
                    $dao->delete($cargo);
                }
                $msg = "Cargos(s) deletado(s) com sucesso.";
                $response->addScript("js.promptMenssage('Exclusão de Cargos','{$msg}',false)");
                $response->addScript("GestaoCargos.initList()");
            } catch (Exception $e) {
                $msg = "Falha ao excluir alguns cargos. Recomece do Inicio.";
                $response->addScript("js.promptMenssage('Exclusão de Cargos','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informações necessárias para excluir cargos não foram informadas corretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Exclusão de Funcionários','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>