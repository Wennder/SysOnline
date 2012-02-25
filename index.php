<?php
<<<<<<< HEAD
require_once './include/initialize.php';
require_once './classes/base/interface/ObjectGUI.class.php';
require_once './classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
=======
require_once 'include/initialize.php';
require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';
>>>>>>> 915a04da0d9d450c66fcbddae355a1005cf8095c

$pagina = new ObjectGUI ( "HTMLogin.tpl" );

	$idUsuario = ControleAcesso::getIdUsuarioOnline ();

	$pagina->assign ( "titulo", "SysAudi 2.0 - Sistema de auditoria interna" );
<<<<<<< HEAD
	$pagina->assign ( "conteudo", $pagina->fetch ( "./admin/login.tpl" ) );
=======
	$pagina->assign ( "conteudo", $pagina->fetch ( "admin/login.tpl" ) );
>>>>>>> 915a04da0d9d450c66fcbddae355a1005cf8095c

$pagina->toHTML ();
?>
	