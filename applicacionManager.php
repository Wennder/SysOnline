<?php
require_once ("include/initialize.php");

set_time_limit(0);

require_once ("classes/modelo/admin/controle/admin/ApplicationManagerAdmin.class.php");
require_once ("classes/base/sistema/Util.class.php");

$app = new ApplicationManagerAdmin();

$app->run();

?>