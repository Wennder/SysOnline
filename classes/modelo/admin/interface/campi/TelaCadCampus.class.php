<?php

require_once 'classes/modelo/admin/controle/campi/GestaoCampi.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';

class TelaCadCampus extends ObjectGUI {

    private $campus = null;

    public function __construct($campus = null) {
        parent::__construct("campi/cadCampus.tpl");

        $this->campus = $campus;
    }

    public function setDados($campus) {
        $this->campus = $campus;
    }

    public function processAssign() {
        if ($this->campus != NULL) {
            $this->assign("actionForm", 'ExecEditCampusAction');
            $this->assign("campus", $this->campus);
        } else {
            $this->assign("actionForm", 'ExecCadCampusAction');
        }

        $paramsData ['idForm'] = "formSaveCampus";
        $paramsData ['sufixo'] = "Pub";

        $this->assign("titulo", "Inserчуo de Campus");
    }

}

?>