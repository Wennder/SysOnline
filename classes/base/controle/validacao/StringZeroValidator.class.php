<?php

require_once (dirname(__FILE__) . "/AbstractFieldValidator.class.php");

class StringZeroValidator extends AbstractFieldValidator {

    public function validate($coordinator) {
        $str = $coordinator->get($this->getFieldname());
        if ($str != "0") {
            $coordinator->setClean($this->getFieldname());
            return TRUE;
        } else {
            $coordinator->addError($this->getFieldname(), $this->getMessage());
            return FALSE;
        }
    }

}

?>