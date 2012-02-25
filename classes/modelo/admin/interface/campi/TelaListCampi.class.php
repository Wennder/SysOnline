<?php

require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/controle/campi/GestaoCampi.class.php';

class TelaListCampi extends ObjectGUI {

    public function __construct() {
        parent::__construct("campi/listCampi.tpl");
    }

    public function processAssign() {
        $this->assign("titulo", "Listagem de Campi");
        $this->assign("optionsOrdem", GestaoCampi::getCamposOrdemLista(TRUE));
        $this->assign("optionsSentidoOrdem", ListagemUtil::getMapSenditoOrdem(TRUE));
    }

}

?>