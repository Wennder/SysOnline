<?php

require_once("classes/base/entidade/ObjectDB.class.php");

class Fluxo extends ObjectDB
{
	public static function loadFluxos($idUsuario)
	{
		$dbConn	= DatabaseConnectionFactory::getDefaultConnection();
		
		$sql	= "select stbfluxo.idFluxo, stbfluxo.nome, stbfluxo.idCasoDeUso, stbusuario_stbfluxo.idUsuario as priv
				from stbfluxo 
				left join stbusuario_stbfluxo on stbusuario_stbfluxo.idFluxo = stbfluxo.idFluxo 
					and stbusuario_stbfluxo.idUsuario = {$idUsuario}";
	
		$dbResult = $dbConn->query($sql);
		
		if ($dbResult->rowCount() > 0)
		{
			return $dbResult->getAllResult();
		}
		else
		{
			return false;
		}
	}

}
?>