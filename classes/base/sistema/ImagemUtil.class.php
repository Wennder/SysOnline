<?php
require_once 'classes/base/sistema/Imagem.class.php';

class ImagemUtil
{
	const HORIZONTAL = 1;
	const VERTICAL = 2;
	const WIDE = 3;
	const PROPORCAO_HORIZONTAL = 1.333; // 4/3
	const PROPORCAO_VERTICAL = 0.75; // 3/4
	const PROPORCAO_WIDE = 1.778; // 16/9	
	

	public function createThumb($params)
	{
		$pImg ['filePath'] = $params ['fileSrc'];
		
		$pThumb ['filePath'] = $params ['fileDest'];
		$pThumb ['width'] = $params ['width'];
		$pThumb ['height'] = $params ['height'];
		$pThumb ['qualidadeJPG'] = isset($params ['qualidadeJPG']) ? $params ['qualidadeJPG'] : 90;
		
		$imagem = new Imagem($pImg);
		
		$imagem->createThumb($pThumb);
	}
	
	public function getTypeDim($fileSrc)
	{
		$info = getimagesize($fileSrc);
		
		$p = round($info [0] / $info [1], 3);
		
		if ($p >= (self::PROPORCAO_HORIZONTAL - 0.01) and ($p <= self::PROPORCAO_HORIZONTAL + 0.01))
		{
			return self::HORIZONTAL;
		} elseif ($p >= (self::PROPORCAO_VERTICAL - 0.01) and ($p <= self::PROPORCAO_VERTICAL + 0.01))
		{
			return self::VERTICAL;
		} elseif ($p >= (self::PROPORCAO_WIDE - 0.01) and ($p <= self::PROPORCAO_WIDE + 0.01))
		{
			return self::WIDE;
		} else
		{
			return self::HORIZONTAL;
		}
	}
}

?>
