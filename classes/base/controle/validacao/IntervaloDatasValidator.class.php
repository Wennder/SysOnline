<?php

require_once 'classes/base/controle/validacao/AbstractFieldValidator.class.php';

class IntervaloDatasValidator extends AbstractFieldValidator {

    private $dataInicio;
    private $dataFim;

    public function __construct($dataInicio, $dataFim, $message) {
        parent::__construct("", $message);

        $this->dataInicio = (!empty($dataInicio)) ? ($dataInicio) : ("");
        $this->dataFim = (!empty($dataFim)) ? ($dataFim) : ("");
    }

    public function validate($coordinator) {
        $ok = true;

        $dataInicio = $coordinator->get($this->dataInicio);
        $dataFim = $coordinator->get($this->dataFim);

        $dataInicio = ($dataInicio) ? Data::desfotmatForUnixTime($dataInicio) : "";
        $dataFim = ($dataFim) ? Data::desfotmatForUnixTime($dataFim) : "";

        if ($dataFim < $dataInicio) {
            $coordinator->addError($this->dataInicio, $this->getMessage());
            $coordinator->addError($this->dataFim, $this->getMessage());
            $ok = false;
        } else {
            $coordinator->setClean($this->dataInicio);
            $coordinator->setClean($this->dataFim);
            $ok = true;
        }

        return $ok;
    }

}

?>
