<?php

require_once 'classes/modelo/admin/controle/curso/GestaoCurso.class.php';
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/modelo/admin/entidade/curso/DAOCurso.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/curso/Curso.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';

class ExecCadCursoAction extends AbstractAction {

    public function execute() {
        $response = new FormErrorResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCurso::validateRequestCad($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $curso = new Curso();

            $curso->setNome($cleanRequest->get('nome'));

            $daoCurso = new DAOCurso();

            try {
                $dbConn = $daoCurso->getDbConn();
                $dbConn->beginTrans();

                $daoCurso->save($curso);

                $dbConn->commitTrans();

                $msg = "Cadastro concluído com sucesso.";
                $response->addScript("FormUtil.resetErrors('{$rawRequest->getFormId()}')");
                $response->addScript("js.promptMenssage('Cadastro de Curso','{$msg}',false)");
                $response->addScript("GestaoCurso.initList()");
            } catch (Exception $e) {
                $response->addAlert(Util::debugVar($e));
                $dbConn->rollBackTrans();
                $msg = "O cadastro deste curso não pôde ser concluído. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Cadastro de Curso','{$msg}',true)");
            }
        } else {
            $response->prepare($controlValidation->getErrors(), $rawRequest->getFormId());
        }

        $this->setResponse($response);
    }

}

?>