<?php

require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/controle/curso/GestaoCurso.class.php';
require_once 'classes/modelo/admin/entidade/curso/Curso.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/curso/DAOCurso.class.php';

class ExecEditCursoAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCurso::validateRequestCad($rawRequest, true);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $curso = new Curso();

            $curso->setIdCurso($cleanRequest->get('idCurso'));
            $curso->setNome($cleanRequest->get('nome'));

            try {
                $daoCurso = new DAOCurso();

                $daoCurso->update($curso);

                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $msg = "Alteraзгo concluнda com sucesso.";
                $response->addScript("js.promptMenssage('Alteraзгo de Curso','{$msg}',false)");
                $response->addScript("GestaoCurso.initList()");
            } catch (Exception $e) {
                $msg = "A alteraзгo deste curso nгo pфde ser concluнda. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Alteraзгo de Curso','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>