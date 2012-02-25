<?php

require_once 'classes/base/sistema/Data.class.php';
require_once 'classes/base/controle/validacao/AbstractFieldValidator.class.php';

class DataValidator extends AbstractFieldValidator
{
	const FORMAT_DATETIME = 1;
	const FORMAT_DATE = 2;
	const FORMAT_TIME = 3;
	
	private $fieldDia;
	private $fieldMes;
	private $fieldAno;
	private $fieldHora;
	private $fieldMin;
	private $checkDate;
	private $checkTime;
	
	public function __construct($fieldDia, $fieldMes, $fieldAno, $fieldHora, $fieldMin, $message, $formato = null)
	{
		parent::__construct("", $message);
		
		switch ( $formato)
		{
			case self::FORMAT_DATE :
				$this->checkDate = TRUE;
				$this->checkTime = FALSE;
			break;
			case self::FORMAT_TIME :
				$this->checkDate = FALSE;
				$this->checkTime = TRUE;
			break;
			case self::FORMAT_DATETIME :
				$this->checkDate = TRUE;
				$this->checkTime = TRUE;
			break;
			default :
				$this->checkDate = TRUE;
				$this->checkTime = TRUE;
			break;
		}
		
		$this->fieldDia = (!empty($fieldDia)) ? ($fieldDia) : ("");
		$this->fieldMes = (!empty($fieldMes)) ? ($fieldMes) : ("");
		$this->fieldAno = (!empty($fieldAno)) ? ($fieldAno) : ("");
		$this->fieldHora = (!empty($fieldHora)) ? ($fieldHora) : ("");
		$this->fieldMin = (!empty($fieldMin)) ? ($fieldMin) : ("");
	}
	
	public function validate($coordinator)
	{
		$ok = true;
		
		$ano = $coordinator->get($this->fieldAno);
		$mes = $coordinator->get($this->fieldMes);
		$dia = $coordinator->get($this->fieldDia);
		$hora = $coordinator->get($this->fieldHora);
		$min = $coordinator->get($this->fieldMin);
		
		$anoAtual = Data::getAno();
		if ($this->checkDate)
		{
			if (($ano > $anoAtual + 10) or ($ano < $anoAtual - 100))
			{
				$coordinator->addError($this->fieldAno, $this->getMessage());
				$ok = FALSE;
			} else
			{
				$coordinator->setClean($this->fieldAno);
			}
			
			if (($mes > 12) or ($mes < 1))
			{
				$coordinator->addError($this->fieldMes, $this->getMessage());
				$ok = FALSE;
			} else
			{
				$coordinator->setClean($this->fieldMes);
			}
			
			$maxDias = Data::getNumDias($mes, $ano);
			
			if (($dia > $maxDias) or ($dia < 1))
			{
				$coordinator->addError($this->fieldDia, $this->getMessage());
				$ok = FALSE;
			} else
			{
				$coordinator->setClean($this->fieldDia);
			}
		}
		
		if ($this->checkTime)
		{
			if (($hora > 23) or ($hora < 0))
			{
				$coordinator->addError($this->fieldHora, $this->getMessage());
				$ok = FALSE;
			} else
			{
				$coordinator->setClean($this->fieldHora);
			}
			
			if (($min > 59) or ($min < 0))
			{
				$coordinator->addError($this->fieldMin, $this->getMessage());
				$ok = FALSE;
			} else
			{
				$coordinator->setClean($this->fieldMin);
			}
		}
		
		return $ok;
	}
}

?>
