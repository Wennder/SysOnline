<?php

require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOGrupo.class.php';
require_once 'classes/modelo/admin/controle/cargos/GestaoCargos.class.php';

class TelaListCargos extends ObjectGUI {

    public function __construct() {
        parent::__construct("cargos/listCargos.tpl");
    }

    public function processAssign() {
        $this->assign("titulo", "Listagem de Cargos");
        $this->assign("optionsOrdem", GestaoCargos::getCamposOrdemLista(TRUE));
        $this->assign("optionsSentidoOrdem", ListagemUtil::getMapSenditoOrdem(TRUE));
//        $this->assign("verificaEdicaoCargo", self::verificaEdicaoCargo());
    }

//    public static function verificaEdicaoCargo() {
//
//        $usuarioLogado = ControleAcesso::unserializeInfoUsuario ();
//        $boolean = DAOGrupo::verificaPermissionGeneric("7", $usuarioLogado['idUsuario']);
//
//        return $boolean;
//    }

}

?>