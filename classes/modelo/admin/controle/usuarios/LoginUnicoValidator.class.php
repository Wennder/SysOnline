<?php

require_once 'classes/modelo/admin/entidade/usuarios/DAOUsuario.class.php';
require_once 'classes/base/controle/validacao/AbstractFieldValidator.class.php';

class LoginUnicoValidator extends AbstractFieldValidator {

    public function validate($coordinator) {
        if (!DAOUsuario::checkExistLogin($coordinator->get($this->getFieldname()))) {
            $coordinator->setClean($this->getFieldname());
            return TRUE;
        } else {
            $coordinator->addError($this->getFieldname(), $this->getMessage());
            return FALSE;
        }
    }
}

?>