<?php

require_once 'classes/modelo/admin/entidade/campi/Campus.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/controle/campi/GestaoCampi.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/interface/campi/TelaCadCampus.class.php';
require_once 'classes/modelo/admin/entidade/campi/DAOCampus.class.php';

class InitEditCampusAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse();

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCampi::validateRequestInitAlt($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();
            $idCampus = $cleanRequest->get("idCampus");

            $dao = new DAOCampus();
            $campus = new Campus();

            $campus->setIdCampus($idCampus);

            $dao->load($campus);

            if ($campus->isLoaded()) {
                $tela = new TelaCadCampus();
                $tela->setDados($dao->toArray($campus));
                $tela->processAssign();

                $response->addAssign("tela", "innerHTML", $tela->getHTML());
                $response->addScript("js.changeTitle('Ediчуo de Campus - SysAudi')");
                $response->addAssign("tituloTela", "innerHTML", "Ediчуo de Campus");
                $response->addScript("FormUtil.initForm('formSaveCampus')");
            } else {
                $msg = "O campus informado para alteraчуo nуo foi encontrado. Recomece do inicio.";
                $response->addScript("js.promptMenssage('Alteraчуo de Campus','{$msg}',true)");
            }
        } else {
            $msg = "Algumas informaчѕes necessсrias para alterar um campus foram informadas incorretamente. Recomece do inicio.";
            $response->addScript("js.promptMenssage('Alteraчуo de Campus','{$msg}',true)");
        }

        $this->setResponse($response);
    }

}

?>