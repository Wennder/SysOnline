<?php

require_once 'classes/base/sistema/Data.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';

class TelaCadUsuario extends ObjectGUI {

    private $usuario = null;
    private $usuarioInfo = null;

    public function __construct($usuario = null) {
        parent::__construct("usuarios/cadUsuario.tpl");

        $this->usuario = $usuario;
    }

    public function setDados($usr, $info) {
        $this->usuario = $usr;
        $this->usuarioInfo = $info;
    }

    public function processAssign() {

        if ($this->usuario != NULL) {
            $this->assign("actionForm", 'ExecEditUsuarioAction');
            $this->assign("usuario", $this->usuario);
            $this->assign("usuarioInfo", $this->usuarioInfo);
        } else {
            $this->assign("actionForm", 'ExecCadUsuarioAction');
        }

        $paramsData ['idForm'] = "formSaveUsuario";
        $paramsData ['sufixo'] = "Pub";

        $this->assign("titulo", "Inserчуo de Usuсrios");
    }

}

?>