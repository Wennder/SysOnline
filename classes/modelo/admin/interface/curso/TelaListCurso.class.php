<?php

require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOGrupo.class.php';
require_once 'classes/modelo/admin/controle/curso/GestaoCurso.class.php';

class TelaListCurso extends ObjectGUI {

    public function __construct() {
        parent::__construct("curso/listCurso.tpl");
    }

    public function processAssign() {
        $this->assign("titulo", "Listagem de Curso");
        $this->assign("optionsOrdem", GestaoCurso::getCamposOrdemLista(TRUE));
        $this->assign("optionsSentidoOrdem", ListagemUtil::getMapSenditoOrdem(TRUE));
//        $this->assign("verificaEdicaoCurso", self::verificaEdicaoCurso());
    }

//    public static function verificaEdicaoCurso() {
//
//        $usuarioLogado = ControleAcesso::unserializeInfoUsuario ();
//        $boolean = DAOGrupo::verificaPermissionGeneric("7", $usuarioLogado['idUsuario']);
//
//        return $boolean;
//    }

}

?>