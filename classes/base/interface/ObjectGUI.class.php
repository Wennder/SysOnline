<?php

define('SMARTY_DIR', DIR_BASE . '/include/Smarty_2_6_12/libs/');
require_once (SMARTY_DIR . 'Smarty.class.php');

/**
 * Classe de nível mais alto que abstrai algunas funcionalidades e agrega outras ao Smarty
 *
 */

function smarty_block_dynamic($param, $content, &$smarty)
{
	return $content;
}

class ObjectGUI extends Smarty
{
	
	private $tpl;
	
	public function __construct($tpl = null)
	{
		parent::Smarty();
		
		$this->register_block('dynamic', "smarty_block_dynamic", false);
		
		$this->template_dir = DIR_BASE . "/smarty_admin/templates";
		$this->compile_dir = DIR_BASE . "/smarty_admin/templates_c";
		$this->config_dir = DIR_BASE . "/smarty_admin/config";
		$this->cache_dir = DIR_BASE . "/smarty_admin/cache";
		
		if (!empty($tpl))
		{
			$this->tpl = $tpl;
		}
	}
	
	public function resetDirTpl()
	{
		$this->template_dir = "templates";
		$this->compile_dir = "templates_c";
		$this->config_dir = "config";
		$this->cache_dir = "cache";
	}
	
	public function setTpl($tpl)
	{
		$this->tpl = $tpl;
	}
	
	function getTpl()
	{
		return $this->tpl;
	}
	
	public function toHTML()
	{
		parent::display($this->tpl);
	}
	
	public function getHTML()
	{
		return parent::fetch($this->tpl);
	}
	
	public function getCode()
	{
		return self::getHTML();
	}
	
	public static function viewFlash($flash)
	{
		$out = "<object type=\"application/x-shockwave-flash\" data=\"{$flash['src']}\" width=\"{$flash['width']}\" height=\"{$flash['height']}\">
            		<param name=\"movie\" value=\"{$flash['src']}\" />
            		<param name=\"wmode\" value=\"transparent\"/>
            		<param name=\"FlashVars\" value=\"clickTag={$flash['link']}\" />
        		</object>";
		
		return $out;
	}
	
	public static function viewImagem($img)
	{
		$out = "<a href=\"{$img['link']}\" target=\"_blank\"><img src=\"{$img['src']}\" width=\"{$img['width']}\" height=\"{$img['height']}\" /></a>";
		
		return $out;
	}
	
	public static function arrayPaginacao($pag, $numPags, $padrao)
	{
		if (($pag - $padrao) > 0)
		{
			$inicio = $pag - $padrao;
		} else
		{
			$inicio = 1;
		}
		if (($pag + $padrao) < $numPags)
		{
			$fim = $pag + $padrao;
		} else
		{
			$fim = $numPags;
		}
		
		if ($fim > $inicio)
		{
			$arrayPags = array ( );
			for($i = $inicio; $i <= $fim; $i ++)
			{
				$arrayPags [] = $i;
			}
		} else
		{
			$arrayPags = null;
		}
		
		return $arrayPags;
	}
	
	public static function paginacao($post, $pagAtual, $num, $action, $total)
	{
		$hidden = "";
		if (!empty($post))
		{
			foreach ( $post as $keysPost => $valuePost )
			{
				$hidden .= "<input type=\"hidden\" name=\"{$keysPost}\" value=\"$valuePost\">\n";
			}
		}
		$form = "<form action=\"\" method=\"post\" id=\"formPaginacao\">\n";
		$form .= $hidden;
		$form .= "</form>\n";
		
		$select = "<label class=\"\">\n" . "Total: {$total}. Páginas: " . "<select class=\"form_item\" id=\"paginacaoPagAtual\" onchange=\"javascript:{$action}(this.value);\">\n";
		for($i = 1; $i <= $num; $i ++)
		{
			if ($i == $pagAtual)
			{
				$select .= "<option value=\"$i\" selected>$i</option>";
			} else
			{
				$select .= "<option value=\"$i\">$i</option>\n";
			}
		}
		$select .= "</select>\n" . "</label>\n";
		
		$output = $form;
		$output .= $select;
		
		return $output;
	}
	
	function processAssign()
	{
	
	}

}

?>