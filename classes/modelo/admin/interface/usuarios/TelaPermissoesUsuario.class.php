<?php

require_once 'classes/modelo/admin/entidade/controle_acesso/DAOCasoDeUso.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOGrupo.class.php';

class TelaPermissoesUsuario extends ObjectGUI {

    private $idUsuario = 0;

    public function __construct() {
        parent::__construct("usuarios/permissoesUsuarios.tpl");
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function processAssign() {
        $this->assign("idUsuario", $this->idUsuario);
        $this->assign("grupos", DAOGrupo::loadGruposUsuario($this->idUsuario));
        $this->assign("casosDeUso", DAOCasoDeUso::loadPermissao($this->idUsuario));
    }

}

?>