<?php
require_once 'classes/base/sistema/DebugMsg.class.php';

class Imagem
{
	private $filePath;
	private $width;
	private $height;
	private $tipo;
	
	private $debugMsg;
	
	function __construct($params)
	{
		$ok = true;
		
		//Verificação da origem do arquivo
		if (isset($params ['filePath']))
		{
			if (file_exists($params ['filePath']))
			{
				$this->filePath = $params ['filePath'];
			} else
			{
				$this->addDebugMsg("Arquivo não acessível.");
				$ok = false;
			}
		} else
		{
			$this->addDebugMsg("Falta informar o endereço do arquivo");
			$ok = false;
		}
		
		//Verificação do tipo do arquivo
		if ($ok)
		{
			$info = getimagesize($this->filePath);
			
			if ($this->checkType($info))
			{
				$this->width = $info [0];
				$this->height = $info [1];
				$this->tipo = $info [2];
			} else
			{
				$ok = false;
				$this->addDebugMsg("O tipo da imagem fornecida não é válido. Apenas gif ou jpg são suportados.");
			}
		}
	
	}
	
	private function addDebugMsg($msg)
	{
		$this->debugMsg [time()] = $msg;
	}
	
	private function checkType($info)
	{
		$tiposSuportados = array (1, 2 );
		
		if (array_search($info [2], $tiposSuportados) === false)
		{
			return false;
		} else
		{
			return true;
		}
	}
	public function getFilePath()
	{
		return $this->filePath;
	}
	
	public function getTipo()
	{
		return $this->tipo;
	}
	
	public function getWidth()
	{
		return $this->width;
	}
	
	public function getHeight()
	{
		return $this->height;
	}
	
	public function getDebugMsg()
	{
		return $this->debugMsg;
	}
	
	public function createThumb($params, $save = true)
	{
		$params ['imgOrigem'] = $this;
		$thumb = new ImagemThumb($params);
		
		$thumb->create();
		
		if ($save)
		{
			$thumb->saveToFile();
		} else
		{
			$thumb->writeToBrowser();
		}
		
		$thumb->destroy();
		unset($thumb);
	}

}

class ImagemThumb
{
	private $imgOrigem;
	private $imgThumb;
	private $imgTmp;
	private $filePath;
	private $qualidadeJPG;
	private $width;
	private $height;
	private $debugMsg;
	
	public function __construct($params)
	{
		$this->debugMsg = new DebugMsg();
		$ok = true;
		
		//Verificação da imagem de origem
		if (isset($params ['imgOrigem']))
		{
			$this->imgOrigem = $params ['imgOrigem'];
		} else
		{
			$ok = false;
			$this->debugMsg->addMsg("Imagem de origem não foi informada");
		}
		
		//Verificação do destino do arquivo
		if ($ok)
		{
			if (isset($params ['filePath']))
			{
				if (file_exists(dirname($params ['filePath'])))
				{
					$this->filePath = $params ['filePath'];
				} else
				{
					$this->debugMsg->addMsg("Arquivo não acessível.");
					$ok = false;
				}
			} else
			{
				$this->debugMsg->addMsg("Falta informar o endereço de destino do thumbnail");
				$ok = false;
			}
		}
		
		//Verificação das dimensões de destino
		if ($ok)
		{
			$width = isset($params ['width']) ? intval($params ['width']) : 0;
			$height = isset($params ['height']) ? intval($params ['height']) : 0;
			
			if (($width <= 0) or ($height <= 0))
			{
				$this->debugMsg->addMsg("Os parâmetros width e height não foram informados ou estão incorretos");
				$ok = FALSE;
			} else
			{
				$this->width = $width;
				$this->height = $height;
			}
		}
		
		//Verificação da qualidadeJPG
		if ($ok)
		{
			if (isset($params ['qualidadeJPG']))
			{
				$q = intval($params ['qualidadeJPG']);
				if ($q > 0)
				{
					$this->qualidadeJPG = $q;
				} else
				{
					$ok = false;
					$this->debugMsg->addMsg("O qualidadeJPG precisa ser maior que zero.");
				}
			}
		}
	
	}
	
	private function readFromFile()
	{
		$tipo = $this->imgOrigem->getTipo();
		$ok = true;
		
		switch ( $tipo)
		{
			case 1 :
				$this->imgTmp = imagecreatefromgif($this->imgOrigem->getFilePath());
			break;
			case 2 :
				$this->imgTmp = imagecreatefromjpeg($this->imgOrigem->getFilePath());
			break;
			default :
				$this->debugMsg->addMsg("O tipo da imagem fornecida não é válido. Apenas gif ou jpg são suportados.");
				$ok = false;
			break;
		}
		
		return $ok;
	}
	
	public function create()
	{
		if ($this->readFromFile())
		{
			if (function_exists("ImageCreateTrueColor"))
			{
				$this->imgThumb = ImageCreateTrueColor($this->width, $this->height);
			} else
			{
				$this->imgThumb = ImageCreate($this->width, $this->height);
			}
			
			if (function_exists("ImageCopyResampled"))
			{
				ImageCopyResampled($this->imgThumb, $this->imgTmp, 0, 0, 0, 0, $this->width, $this->height, $this->imgOrigem->getWidth(), $this->imgOrigem->getHeight());
			} else
			{
				ImageCopyResized($this->imgThumb, $this->imgTmp, 0, 0, 0, 0, $this->width, $this->height, $this->imgOrigem->getWidth(), $this->imgOrigem->getHeight());
			}
		} else
		{
//			$this->debugMsg->addDebugMsg("A imagem temporária não pôde ser criada.");
			echo "A imagem temporária não pôde ser criada.";
		}
	}
	
	function saveToFile()
	{
		$tipo = $this->imgOrigem->getTipo();
		
		switch ( $tipo)
		{
			case 1 :
				$result = imagegif($this->imgThumb, $this->filePath);
				@chmod($destino, 0777);
				return $result;
			break;
			case 2 :
				$result = imagejpeg($this->imgThumb, $this->filePath, $this->qualidadeJPG);
				@chmod($destino, 0777);
				return $result;
			break;
			default :
				return FALSE;
			break;
		}
	}
	
	function writeToBrowser()
	{
		switch ( $this->type)
		{
			case 2 :
				header("Content-Type: image/jpeg");
				$result = ImageJpeg($this->imgThumb, '', $this->quality);
				return $result;
			break;
			case 3 :
				header("Content-Type: image/png");
				$result = ImagePNG($this->imgThumb);
				return $result;
			break;
			default :
				return FALSE;
			break;
		}
	}
	
	function destroy()
	{
		imagedestroy($this->imgTmp);
		imagedestroy($this->imgThumb);
	}

}

?>
