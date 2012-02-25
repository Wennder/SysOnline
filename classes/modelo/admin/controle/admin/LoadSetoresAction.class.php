<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/base/sistema/SetorCampusUtil.class.php';

class LoadSetoresAction extends AbstractAction {

    public function execute() {
        $response = new AjaxResponse ( );

        $rawRequest = $this->getRequest();

        $controlValidation = SetorCampusUtil::validateRequest($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $optionsCidade = SetorCampusUtil::getMapSetor($cleanRequest->get('idCampus'));

            $arrayName = $cleanRequest->get('arrayName');

            $jsSetores = "{$arrayName} = new Array();";
            $i = - 1;

            foreach ($optionsCidade as $idSetor => $nome) {
                $i++;
                $nome = addslashes($nome);

                $jsSetores .= "{$arrayName}[{$i}] = new Array();";
                $jsSetores .= "{$arrayName}[{$i}]['txt'] = '{$nome}';";
                $jsSetores .= "{$arrayName}[{$i}]['valor'] = '{$idSetor}';";
            }

            $jsSetores .= "BaseAdmin.execOptions('{$cleanRequest->get('idSelect')}', {$arrayName})";

            $response->addScript($jsSetores);
        }

        $this->setResponse($response);
    }

}

?>
