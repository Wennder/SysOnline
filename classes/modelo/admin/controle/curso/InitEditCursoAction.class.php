<?php

require_once 'classes/modelo/admin/entidade/curso/Curso.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/curso/GestaoCurso.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/curso/TelaCadCurso.class.php';
require_once 'classes/modelo/admin/entidade/curso/DAOCurso.class.php';

class InitEditCursoAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCurso::validateRequestInitAlt($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $idCurso = $cleanRequest->get("idCurso");

            $dao = new DAOCurso();
            $curso = new Curso();

            $curso->setIdCurso($idCurso);

            $dao->load($curso);

            if ($curso->isLoaded()) {
                $tela = new TelaCadCurso();
                $tela->setDados($dao->toArray($curso));
                $tela->processAssign();

                $response->addAssign("tela", "innerHTML", $tela->getHTML());
                $response->addScript("js.changeTitle('Edi��o de Curso - SysAudi')");
                $response->addAssign("tituloTela", "innerHTML", "Edi��o de Curso");
                $response->addScript("FormUtil.initForm('formSaveCurso')");
            } else {
                $msg = "O curso informado para altera��o n�o foi encontrado. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Altera��o de Curso','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informa��es necess�rias para alterar um curso foram informadas incorretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Altera��o de Curso','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>