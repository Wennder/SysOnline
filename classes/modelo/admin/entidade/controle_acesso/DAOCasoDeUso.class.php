<?php
require_once 'classes/base/entidade/DAOObjectDB.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';

class DAOCasoDeUso extends DAOObjectDB
{

	public static function loadVisiveis($idUsuario)
	{
		$dbConn = DatabaseConnectionFactory::getDefaultConnection();

		$sql = "select stbcaso_de_uso.idCasoDeUso, stbcaso_de_uso.nome, stbcaso_de_uso.descricao, stbitem_menu.idItemMenu,
					stbitem_menu.nome as item, stbitem_menu.descricao as descItem, stbitem_menu.linkJS
		from stbitem_menu
		left join stbfluxo on stbfluxo.idFluxo = stbitem_menu.idFluxo
		left join stbcaso_de_uso on stbfluxo.idCasoDeUso = stbcaso_de_uso.idCasoDeUso
		inner join stbusuario_stbfluxo on stbfluxo.idFluxo = stbusuario_stbfluxo.idFluxo
		and stbusuario_stbfluxo.idUsuario = '{$idUsuario}'
		order by stbcaso_de_uso.ordem asc, item asc";

		$dbResult = $dbConn->query($sql);

		if ($dbResult->rowCount() > 0)
		{
			return $dbResult->getAllResult();
		} else
		{
			return false;
		}
	}
	
	public static function loadPermissao($idUsuario)
	{
		$dbConn = DatabaseConnectionFactory::getDefaultConnection();
		
		$sql = "select stbcaso_de_uso.idCasoDeUso, stbcaso_de_uso.nome, stbcaso_de_uso.descricao,
					stbfluxo.idFluxo, stbfluxo.nome as nomeFluxo, stbfluxo.descricao as descFluxo, stbusuario_stbfluxo.idUsuario as permissao
				from stbcaso_de_uso
				left join stbfluxo on stbfluxo.idCasoDeUso = stbcaso_de_uso.idCasoDeUso
				left join stbusuario_stbfluxo on stbfluxo.idFluxo = stbusuario_stbfluxo.idFluxo
					and stbusuario_stbfluxo.idUsuario = '{$idUsuario}'";
		
		$dbResult = $dbConn->query($sql);
		
		if ($dbResult->rowCount() > 0)
		{
			$itens = $dbResult->getAllResult();
			$result = array ( );
			for($i = 0; $i < count($itens); $i ++)
			{
				$fluxo ['idFluxo'] = $itens [$i] ['idFluxo'];
				$fluxo ['nome'] = $itens [$i] ['nomeFluxo'];
				$fluxo ['descricao'] = $itens [$i] ['descFluxo'];
				$fluxo ['permissao'] = $itens [$i] ['permissao'];
				
				$result [$itens [$i] ['idCasoDeUso']] ['idCasoDeUso'] = $itens [$i] ['idCasoDeUso'];
				$result [$itens [$i] ['idCasoDeUso']] ['nome'] = $itens [$i] ['nome'];
				$result [$itens [$i] ['idCasoDeUso']] ['descricao'] = $itens [$i] ['descricao'];
				$result [$itens [$i] ['idCasoDeUso']] ['fluxos'] [] = $fluxo;
			}
			
			unset($itens);
			
			return $result;
		} else
		{
			return false;
		}
	}
	
	public static function updateFluxos($idUsuario, $listaFluxos)
	{
		self::clearFluxos($idUsuario);
		
		if (count($listaFluxos) > 0)
		{
			$values = array ( );
			
			foreach ( $listaFluxos as $idFluxo )
			{
				$values [] = "({$idUsuario}, $idFluxo)";
			}
			
			$strValues = implode(", ", $values);
			
			$sql = "insert into stbusuario_stbfluxo (idUsuario, idFluxo) values {$strValues}";
			
			$dbConn = DatabaseConnectionFactory::getDefaultConnection();
			
			$dbConn->query($sql);
		}
	}
	
	private function clearFluxos($idUsuario)
	{
		
		$sql = "delete from stbusuario_stbfluxo where idUsuario = '{$idUsuario}'";
		
		$dbConn = DatabaseConnectionFactory::getDefaultConnection();
		
		$dbConn->query($sql);
	}

}
?>