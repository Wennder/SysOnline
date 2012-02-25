<?php

require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';

class TelaCadCarregarFuncionario extends ObjectGUI {

    public function __construct() {
        parent::__construct("funcionarios/cadCarregamentoFuncionario.tpl");
    }

    public function processAssign() {
        
    }

}

?>