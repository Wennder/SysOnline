<?php

require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/modelo/admin/interface/admin/TelaIndex.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/Usuario.class.php';
require_once 'classes/base/sistema/Data.class.php';
//require_once 'classes/modelo/admin/entidade/produtos/DAOProduto.class.php';

class InitIndexAction extends AbstractAction
{
	public function execute()
	{
		$response = new AjaxResponse ( );
		
		$tela = new TelaIndex ( );
		$tela->processAssign ();
		
		$usuario = ControleAcesso::unserializeInfoUsuario ();
				
		$response->addScript ( "js.changeTitle('Página Inicial - SysAudi')" );
		$response->addAssign ( "tituloTela", "innerHTML", "Página Inicial" );
		$response->addAssign ( "user_on", "innerHTML", $usuario ['nome'] );
		$response->addAssign ( "tela", "innerHTML", $tela->getHTML () );
		$response->addAssign ( "numMinimo", "innerHTML", DAOProduto::getNumMinimo () );
		$response->addAssign ( "saudacaoTemporal", "innerHTML", Data::getDataExt () );
		
		$this->setResponse ( $response );
	}

}

?>