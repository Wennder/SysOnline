<?php
require_once 'classes/base/sistema/DebugMsg.class.php';

class UploadFile
{
	private $arquivo;
	private $nome;
	private $diretorio;
	private $mime;
	private $extensao;
	private $fileOK;
	private $debugMsg;
	
	public function __construct($params)
	{
		$this->debugMsg = new DebugMsg ( );
		$ok = true;
		
		if (isset ( $params ['diretorio'] ))
		{
			if (file_exists ( $params ['diretorio'] ))
			{
				$this->diretorio = $params ['diretorio'];
			} else
			{
				$this->debugMsg->addMsg ( "Diretório inacessível" );
				$ok = false;
			}
		} else
		{
			$this->debugMsg->addMsg ( "Falta informar o diretório" );
			$ok = false;
		}
		
		if ($ok)
		{
			if (isset ( $params ['arquivo'] ))
			{
				$this->setArquivo ( $params ['arquivo'] );
			} else
			{
				$this->debugMsg->addMsg ( "Falta informar o arquivo" );
			}
		}
	}
	
	private function getMapMime()
	{
		$mapMime ["image/jpeg"] = "jpg";
		$mapMime ["image/pjpeg"] = "jpg";
		$mapMime ["image/gif"] = "gif";
		$mapMime ["application/pdf"] = "pdf";
		$mapMime ["application/x-shockwave-flash"] = "swf";
		
		return $mapMime;
	}
	
	private function loadExtensao($mime)
	{
		$mapMime = self::getMapMime ();
		$extensao = isset ( $mapMime [$mime] ) ? $mapMime [$mime] : FALSE;
		return $extensao;
	}
	
	private function getRandNome()
	{
		$aux = explode ( '.', $this->arquivo ['name'] );		
		return $aux [0] . '_' . md5 ( uniqid ( time () ) ) . "." . $this->extensao;
	}
	
	public function setArquivo($arquivo = false)
	{
		$this->fileOK = FALSE;
		
		if ($arquivo)
		{
			$mime = $arquivo ['type'];
			$extensao = self::loadExtensao ( $mime );
			
			if (! empty ( $extensao ))
			{
				$this->arquivo = $arquivo;
				$this->mime = $mime;
				$this->extensao = $extensao;
				
				$this->fileOK = TRUE;
			}
		}
	}
	
	public function getArquivo()
	{
		return $this->arquivo;
	}
	
	public function setNome($nome = false)
	{
		if (! $nome)
		{
			$nome = $this->getRandNome ();
		}
		
		$this->nome = $nome;
	}
	
	public function getNome()
	{
		return $this->nome;
	}
	
	public function setDiretorio($dir)
	{
		$this->diretorio = $dir;
	}
	
	public function getDiretorio()
	{
		return $this->diretorio;
	}
	
	public function getMime()
	{
		return $this->mime;
	}
	
	public function getExtensao()
	{
		return $this->extensao;
	}
	
	public function isSuported()
	{
		return $this->fileOK;
	}
	
	public function deleteFromDisk($diretorioArquivo = false)
	{
		if ($diretorioArquivo)
		{
			$arquivo = $diretorioArquivo;
		} else
		{
			$arquivo = $this->diretorio . $this->nome;
		}
		if (@file_exists ( $arquivo ))
		{
			$result = @unlink ( $arquivo );
		} else
		{
			$result = false;
		}
		
		return $result;
	}
	
	public function saveToDisk()
	{
		if (empty ( $this->nome ))
		{
			$this->nome = $this->getRandNome ();
		}
		
		$filePath = stripslashes ( $this->arquivo ["tmp_name"] );
		
		if (is_uploaded_file ( $filePath ))
		{
			return move_uploaded_file ( $filePath, $this->diretorio . '/' . $this->nome );
		} else
		{
			return FALSE;
		}
	}
	
	public function getDebugMsg($asArray = false)
	{
		if ($asArray)
		{
			return $this->debugMsg->getMsg ();
		} else
		{
			$arrayMsg = $this->debugMsg->getMsg ();
			$str = implode ( "\n", $arrayMsg );
			return $str;
		}
	}
}

?>