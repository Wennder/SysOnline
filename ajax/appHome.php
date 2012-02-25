<?php
require_once ("../include/initialize.php");

require_once ('classes/modelo/site/controle/site/ApplicationManagerHome.class.php');
require_once ("classes/base/sistema/Util.class.php");

$app = new ApplicationManagerHome ( );

$app->run ();

?>