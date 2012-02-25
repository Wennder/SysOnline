<?php

require_once 'classes/base/sistema/Data.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOGrupo.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';

class TelaCadCargo extends ObjectGUI {

    private $cargo = null;

    public function __construct($cargo = null) {
        parent::__construct("cargos/cadCargo.tpl");

        $this->cargo = $cargo;
    }

    public function setDados($usr) {
        $this->cargo = $usr;
    }

    public function processAssign() {
        if ($this->cargo != NULL) {
            $this->assign("actionForm", 'ExecEditCargoAction');
            $this->assign("cargo", $this->cargo);
        } else {
            $this->assign("actionForm", 'ExecCadCargoAction');
        }

        $paramsData ['idForm'] = "formSaveCargo";
        $paramsData ['sufixo'] = "Pub";

        $this->assign("titulo", "Inserчуo de Cargos");
//        $this->assign("verificaListagemCargo", self::verificaListagemCargo());
    }

//    public static function verificaListagemCargo() {
//
//        $usuarioLogado = ControleAcesso::unserializeInfoUsuario ();
//        $boolean = DAOGrupo::verificaPermissionGeneric("6", $usuarioLogado['idUsuario']);
//
//        return $boolean;
//    }

}

?>