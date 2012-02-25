<?php
require_once 'classes/base/sistema/Util.class.php';
require_once 'classes/base/controle/filtros/AbstractRequestFilter.class.php';
/**
 * Filtro responsável por decodificar dados de utf-8 para iso-8859-1 usando internamente a funcao utf8_decode
 * @author Jackson Cereb
 */
class UTF8Filter extends AbstractRequestFilter
{
	public static function execute($request)
	{
		$dados = $request->getData();
		
		$dados = Util::decodeUTF8($dados);
		
		$request->setData( $dados );
	}
}
?>