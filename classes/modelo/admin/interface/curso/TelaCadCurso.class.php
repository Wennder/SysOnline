<?php

require_once 'classes/base/sistema/Data.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOGrupo.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';

class TelaCadCurso extends ObjectGUI {

    private $curso = null;

    public function __construct($curso = null) {
        parent::__construct("curso/cadCurso.tpl");

        $this->curso = $curso;
    }

    public function setDados($usr) {
        $this->curso = $usr;
    }

    public function processAssign() {
        if ($this->curso != NULL) {
            $this->assign("actionForm", 'ExecEditCursoAction');
            $this->assign("curso", $this->curso);
        } else {
            $this->assign("actionForm", 'ExecCadCursoAction');
        }

        $paramsData ['idForm'] = "formSaveCurso";
        $paramsData ['sufixo'] = "Pub";

        $this->assign("titulo", "Inserчуo de Curso");
//        $this->assign("verificaListagemCurso", self::verificaListagemCurso());
    }

//    public static function verificaListagemCurso() {
//
//        $usuarioLogado = ControleAcesso::unserializeInfoUsuario ();
//        $boolean = DAOGrupo::verificaPermissionGeneric("6", $usuarioLogado['idUsuario']);
//
//        return $boolean;
//    }

}

?>