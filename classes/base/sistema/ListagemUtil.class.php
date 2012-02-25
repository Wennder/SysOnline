<?php
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';

class ListagemUtil
{
	const LISTA_ASC = 1;
	CONST lISTA_DESC = 2;

	public function getCampoOrdem($indice, $map)
	{
		return $map [$indice] ['campo'];
	}

	public function formatMapLista($map)
	{
		$optionsOrdem = array ();

		foreach ( $map as $chave => $ordem )
		{
			$optionsOrdem [$chave] = $ordem ['label'];
		}

		return $optionsOrdem;
	}

	public function getMapSenditoOrdem($invert = false)
	{
		if ($invert)
		{
			$map [self::lISTA_DESC] = "Descendente";
			$map [self::LISTA_ASC] = "Ascendente";
		}
		else
		{
			$map [self::LISTA_ASC] = "Ascendente";
			$map [self::lISTA_DESC] = "Descendente";
		}
		return $map;
	}
	
	public function execListagem($filtro)
	{
		if ($filtro != NULL)
		{
			$tabelas = $filtro ['tabelas'];
			$campos = $filtro ['campos'];
			$condicao = $filtro ['condicao'];
			$join = $filtro ['join'];
			$group = $filtro ['group'];
			$ordem = $filtro ['ordem'];
			$li = $filtro ['li'];
			$numItens = $filtro ['numItens'];
			
			if ($numItens > 0)
			{
				$limit = "limit $li, $numItens";
			} else
			{
				$limit = "";
			}
			
			$sql = "select SQL_CALC_FOUND_ROWS {$campos} from {$tabelas} {$join} where {$condicao} {$group} {$ordem} {$limit}";
						
			$sqlCount = "select found_rows() as count;";
			
			$dbConn = DatabaseConnectionFactory::getDefaultConnection ();
			
			$dbResult = $dbConn->query ( $sql );
			$dbResultCount = $dbConn->query ( $sqlCount );
			
			$count = $dbResultCount->getOneResult ();
			$count = $count ['count'];
			$sqlToReports = $sql;
			
			$itens = $dbResult->getAllResult ();
		} else
		{
			$itens = null;
			$count = 0;
		}
		
		if ($itens !== NULL)
		{
			if ($numItens > 0)
			{
				$numPags = ceil ( $count / $numItens );
			} else
			{
				$numPags = 0;
			}
			
			$lista ['itens'] = $itens;
			$lista ['numItens'] = $count;
			$lista ['numItensRetorn'] = count ( $itens );
			$lista ['numPags'] = $numPags;
			unset ($_SESSION['sql']);
			$lista ['sql'] = $sqlToReports;
			$_SESSION['sql'] = $sqlToReports;
		} else
		{
			$lista ['itens'] = array ();
			$lista ['numItens'] = $count;
			$lista ['numItensRetorn'] = 0;
			$lista ['numPags'] = 0;
			$lista ['sql'] = "";
			unset ($_SESSION['sql']);
		}
		
		return $lista;
	}
	
	public function getHTMLPaginacao($post, $numPags, $comp = null)
	{
		$arrayPags = array ();
		for($i = 1; $i <= $numPags; $i ++)
		{
			$arrayPags [$i] = $i;
		}
		$pagAtual = $post ['pag'];
		unset ( $post ['pag'] );
		
		if (is_null ( $comp ))
		{
			$comp = new ObjectGUI ( "base_comp/paginacao.guicomp.tpl" );
		}
		
		$comp->assign ( "arrayPags", $arrayPags );
		$comp->assign ( "pagAtual", $pagAtual );
		$comp->assign ( "numPags", $numPags );
		$comp->assign ( "post", $post );
		$comp->assign ( "sufixo", microtime ( true ) );
		
		return $comp->getHTML ();
	}
}

?>
