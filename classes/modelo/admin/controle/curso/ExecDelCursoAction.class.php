<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/curso/GestaoCurso.class.php';
require_once 'classes/modelo/admin/entidade/curso/DAOCurso.class.php';
require_once 'classes/modelo/admin/entidade/curso/Curso.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';

class ExecDelCursoAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCurso::validateRequestDel($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $idCurso = $cleanRequest->get("idCurso");
            $idCurso = (count($idCurso) > 0) ? $idCurso : array();

            try {
                $dao = new DAOCurso ( );
                $curso = new Curso();

                foreach ($idCurso as $id) {
                    $curso->setIdCurso($id);
                    $dao->load($curso);
                    $dao->delete($curso);
                }
                $msg = "Curso(s) deletado(s) com sucesso.";
                $response->addScript("js.promptMenssage('Exclus�o de Curso','{$msg}',false)");
                $response->addScript("GestaoCurso.initList()");
            } catch (Exception $e) {
                $msg = "Falha ao excluir alguns curso. Recomece do Inicio.";
                $response->addScript("js.promptMenssage('Exclus�o de Curso','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informa��es necess�rias para excluir curso n�o foram informadas corretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Exclus�o de Funcion�rios','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>