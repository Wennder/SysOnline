<?php
require_once 'classes/base/interface/AbstractGuiComp.class.php';
require_once 'classes/base/sistema/Data.class.php';

class DataGuiComp extends AbstractGuiComp
{
	const FORMAT_DATETIME = "datetime";
	const FORMAT_DATE = "date";
	const FORMAT_TIME = "time";
	const FORMAT_MES_ANO = "mes_ano";
	const FORMAT_ANO = "ano";
	
	public function __construct($params = null)
	{
		parent::__construct ( $params );
	}
	
	public function getHTMLComp()
	{
		$this->setTpl ( "base_comp/data.guicomp.tpl" );
		
		$formato = $this->getParam ( 'formato' );
		
		$inicioAno = $this->getParam ( 'inicioAno' );
		$fimAno = $this->getParam ( 'fimAno' );
		
		$sufixo = $this->getParam ( 'sufixo' );
		$idForm = $this->getParam ( 'idForm' );
		$title = $this->getParam ( 'title' );
		
		$diaSel = $this->getParam ( 'diaSel' );
		$mesSel = $this->getParam ( 'mesSel' );
		$anoSel = $this->getParam ( 'anoSel' );
		$horaSel = $this->getParam ( 'horaSel' );
		$minSel = $this->getParam ( 'minSel' );
		
		$optionsDia = Data::getOptionsDia ();
		$optionsMes = Data::getOptionsMes ();
		$optionsAno = Data::getOptionsAno ( $inicioAno, $fimAno );
		$optionsHora = Data::getOptionsHora ();
		$optionsMin = Data::getOptionsMin ();
		
		switch ($formato)
		{
			case self::FORMAT_DATE :
				$this->assign ( "dia", "1" );
				$this->assign ( "mes", "1" );
				$this->assign ( "ano", "1" );
				$this->assign ( "hora", "0" );
				$this->assign ( "min", "0" );
				break;
			case self::FORMAT_TIME :
				$this->assign ( "dia", "0" );
				$this->assign ( "mes", "0" );
				$this->assign ( "ano", "0" );
				$this->assign ( "hora", "1" );
				$this->assign ( "min", "1" );
				break;
			case self::FORMAT_DATETIME :
				$this->assign ( "dia", "1" );
				$this->assign ( "mes", "1" );
				$this->assign ( "ano", "1" );
				$this->assign ( "hora", "1" );
				$this->assign ( "min", "1" );
				break;
			case self::FORMAT_MES_ANO :
				$this->assign ( "dia", "0" );
				$this->assign ( "mes", "1" );
				$this->assign ( "ano", "1" );
				$this->assign ( "hora", "0" );
				$this->assign ( "min", "0" );
				break;
			case self::FORMAT_ANO :
				$this->assign ( "dia", "0" );
				$this->assign ( "mes", "0" );
				$this->assign ( "ano", "1" );
				$this->assign ( "hora", "0" );
				$this->assign ( "min", "0" );
				break;
			default :
				$this->assign ( "dia", "1" );
				$this->assign ( "mes", "1" );
				$this->assign ( "ano", "1" );
				$this->assign ( "hora", "1" );
				$this->assign ( "min", "1" );
				break;
		}
		
		$this->assign ( "idForm", $idForm );
		$this->assign ( "sufixo", $sufixo );
		$this->assign ( "title", $title );
		
		$this->assign ( "optionsDia", $optionsDia );
		$this->assign ( "optionsMes", $optionsMes );
		$this->assign ( "optionsAno", $optionsAno );
		$this->assign ( "optionsHora", $optionsHora );
		$this->assign ( "optionsMin", $optionsMin );
		
		$this->assign ( "diaSel", $diaSel );
		$this->assign ( "mesSel", $mesSel );
		$this->assign ( "anoSel", $anoSel );
		$this->assign ( "horaSel", $horaSel );
		$this->assign ( "minSel", $minSel );
		
		return $this->getHTML ();
	}

}
?>