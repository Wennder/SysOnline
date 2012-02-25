<?php
require_once 'include/initialize.php';
require_once 'classes/base/sistema/Util.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/modelo/admin/controle/controle_acesso/ControleAcesso.class.php';

$pagina = new ObjectGUI ( "HTML.tpl" );

$idUsuario = ControleAcesso::getIdUsuarioOnline ();

if ($idUsuario > 0)
{
	$pagina->assign ( "titulo", "Página Inicial" );
	$pagina->assign ( "selected_inicio", "selected" );
	$pagina->assign ( "arrayCasosDeUso", ControleAcesso::unserializeCasosDeUso () );
	$pagina->toHTML ();

} else
{
	header ( "Location: index.php" );
	exit ();
}

?>
	