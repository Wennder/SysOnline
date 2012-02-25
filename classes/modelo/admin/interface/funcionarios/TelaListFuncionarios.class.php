<?php

require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';

class TelaListFuncionarios extends ObjectGUI {

    public function __construct() {
        parent::__construct("funcionarios/listFuncionarios.tpl");
    }

    public function processAssign() {
        $this->assign("titulo", "Listagem de Funcionários");
        $this->assign("optionsOrdem", GestaoFuncionarios::getCamposOrdemLista(TRUE));
        $this->assign("optionsSentidoOrdem", ListagemUtil::getMapSenditoOrdem(TRUE));
        $this->assign("optionsCargo", GestaoFuncionarios::getCamposCargo ( ));
        $this->assign("optionsCampi", GestaoFuncionarios::getCamposCampi ( ));
        
    }

}

?>