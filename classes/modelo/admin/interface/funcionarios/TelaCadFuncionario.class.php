<?php

require_once 'classes/modelo/admin/controle/funcionarios/GestaoFuncionarios.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';

class TelaCadFuncionario extends ObjectGUI {

    private $funcionario = null;

    public function __construct($funcionario = null) {
        parent::__construct("funcionarios/cadFuncionario.tpl");

        $this->funcionario = $funcionario;
    }

    public function setDados($funcionario) {
        $this->funcionario = $funcionario;
    }

    public function processAssign() {
        if ($this->funcionario != NULL) {
            $this->assign("actionForm", 'ExecEditFuncionarioAction');
            $this->assign("funcionario", $this->funcionario);
        } else {
            $this->assign("actionForm", 'ExecCadFuncionarioAction');
        }

        $paramsData ['idForm'] = "formSaveFuncionario";
        $paramsData ['sufixo'] = "Pub";

        $this->assign("titulo", "Inserчуo de Funcionсrios");
        $this->assign("optionsCargo", GestaoFuncionarios::getMapCargo ());
        $this->assign("optionsCampus", GestaoFuncionarios::getMapCampus ());
    }

}

?>