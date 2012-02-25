<?php
//require_once 'classes/modelo/site/controle/banners/GestaoBannersSite.class.php';
require_once 'classes/base/sistema/Util.class.php';
require_once 'include/include.init.php';
require_once ('classes/base/interface/ObjectGUI.class.php');

class ObjectGUISite extends ObjectGUI
{
	const DIR_BANNER = "imagem/banners";
	
	public function __construct($tpl = null)
	{
		parent::__construct ( $tpl );
		
		$this->template_dir = DIR_BASE . "/smarty_site/templates";
		$this->compile_dir = DIR_BASE . "/smarty_site/templates_c";
		$this->config_dir = DIR_BASE . "/smarty_site/config";
		$this->cache_dir = DIR_BASE . "/smarty_site/cache";
	}
	
	public function htmlBanner($banner)
	{
		if ($banner == NULL)
		{
			return NULL;
		}
		
		//$link = GestaoBannersSite::serializeBanner ( $banner );		
		//$conf ['link'] = $link;
		$conf ['link'] = $banner ['link'];
		$conf ['src'] = BASE_URL . self::DIR_BANNER . "/" . $banner ['arquivo'];
		$conf ['width'] = $banner ['width'];
		$conf ['height'] = $banner ['height'];
		
		if (Util::isFlash ( $banner ['arquivo'] ))
		{
			$htmlBanner = self::viewFlash ( $conf );
		} else
		{
			$htmlBanner = self::viewImagem ( $conf );
		}
		
		return $htmlBanner;
	}
	
	public static function paginacaoLinks($params)
	{
		$pag = $params ['pag'];
		$numPags = $params ['numPags'];
		$padrao = $params ['padrao'];
		$template = $params ['template'];
		$queryString = $params ['query'];
		$url = $params ['url'];
		$anterior = 0;
		$proximo = 0;
		
		if (($pag - $padrao) > 0)
		{
			$inicio = $pag - $padrao;
			$anterior = $inicio - 1;
		} else
		{
			$inicio = 1;
		}
		if (($pag + $padrao) < $numPags)
		{
			$fim = $pag + $padrao;
			$proximo = $fim + 1;
		} else
		{
			$fim = $numPags;
		}
		
		if ($fim > $inicio)
		{
			$arrayPags = array ();
			for($i = $inicio; $i <= $fim; $i ++)
			{
				$arrayPags [] = $i;
			}
			
			$paginacao = new ObjectGUISite ( $template );
			
			$paginacao->assign ( "arrayPaginas", $arrayPags );
			$paginacao->assign ( "paginaAtual", $pag );
			$paginacao->assign ( "numPags", $numPags );
			$paginacao->assign ( "anterior", $anterior );
			$paginacao->assign ( "proximo", $proximo );
			$paginacao->assign ( "query", $queryString );
			$paginacao->assign ( "url", $url );
			
			$html = $paginacao->getHTML ();
		} else
		{
			$html = "";
		}
		
		return $html;
	}
}

?>
