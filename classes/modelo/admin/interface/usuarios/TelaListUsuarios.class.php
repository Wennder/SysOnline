<?php

require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';

class TelaListUsuarios extends ObjectGUI {

    public function __construct() {
        parent::__construct("usuarios/listUsuarios.tpl");
    }

    public function processAssign() {
        $this->assign("titulo", "Listagem de Usuarios");
        $this->assign("optionsOrdem", GestaoUsuarios::getCamposOrdemLista(TRUE));
        $this->assign("optionsSentidoOrdem", ListagemUtil::getMapSenditoOrdem(TRUE));
    }

}

?>