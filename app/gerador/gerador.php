<?php
require_once ("../../include/initialize.php");

require_once 'classes/modelo/admin/controle/gerador/EntidadeGerador.class.php';
require_once 'classes/base/sistema/Util.class.php';

$params ['table'] = "tbdisciplina";
$params ['parentTable'] = "";
$params ['pacote'] = "";
$params ['prefix'] = "tb";

$gerador = new EntidadeGerador($params);
echo "ok";

?>