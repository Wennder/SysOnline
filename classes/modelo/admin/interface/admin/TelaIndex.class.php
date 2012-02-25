<?php

require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/controle/controle_acesso/InitIndexAction.class.php';
require_once 'classes/base/sistema/Data.class.php';

class TelaIndex extends ObjectGUI
{
	public function __construct()
	{
		parent::__construct ( "admin/index.tpl" );
	}
	
	public function processAssign()
	{
		
	}
}

?>