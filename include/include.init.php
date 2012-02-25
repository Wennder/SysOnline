<?php
define("DIR_BASE", "./");
define("DIR_TEMP", DIR_BASE . '/temp');
define('BASE_URL', './');
define('HTTP_URL', './');

$includes[] = ini_get('include_path');

$includes[] = DIR_BASE;

$includesSet = implode(";",$includes);

ini_set('include_path', $includesSet);

?>