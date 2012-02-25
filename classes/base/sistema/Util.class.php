<?php

/**
 * Métodos úteis a todo o sistema
 *
 */
class Util
{
	public static function issetAndNotEmpty($var)
	{
		if ((isset ( $var )) and (! empty ( $var )))
		{
			return true;
		} else
		{
			return false;
		}
	}
	
	public static function debugVar($var, $vaDump = false)
	{
		if ($vaDump)
		{
			ob_start ();
			echo "<pre>";
			var_dump ( $var );
			echo "</pre>";
			$out = ob_get_contents ();
			ob_clean ();
		} else
		{
			ob_start ();
			echo "<pre>";
			print_r ( $var );
			echo "</pre>";
			$out = ob_get_contents ();
			ob_clean ();
		}
		
		return $out;
	}
	
	public static function saveObject($objeto, $dir_file)
	{
		$arquivo = $dir_file;
		$dados = serialize ( $objeto );
		if ($handle = fopen ( $arquivo, "w+" ))
		{
			fwrite ( $handle, $dados );
			fclose ( $handle );
			return true;
		} else
		{
			return false;
		}
	}
	
	public static function saveText($text, $dir_file)
	{
		if ($handle = fopen ( $dir_file, "w+" ))
		{
			fwrite ( $handle, $text );
			fclose ( $handle );
			return true;
		} else
		{
			return false;
		}
	}
	
	public static function readObject($dir_file)
	{
		$dados = file_get_contents ( $dir_file );
		$objeto = unserialize ( $dados );
		return $objeto;
	}
	
	public function readText($dir_file)
	{
		if (file_exists ( $dir_file ))
		{
			$handle = fopen ( $dir_file, 'r' );
			$text = fgets ( $handle );
			fclose ( $handle );
			return $text;
		} else
		{
			return false;
		}
	}
	
	public static function getmicrotime()
	{
		list ( $usec, $sec ) = explode ( " ", microtime () );
		return (( float ) $usec + ( float ) $sec);
	}
	
	public static function clearLines($string)
	{
		$string = str_replace ( "\n", "", $string );
		$string = str_replace ( "\r", "", $string );
		$string = str_replace ( "\t", "", $string );
		$string = str_replace ( '"', '\"', $string );
		return $string;
	}
	
	public static function escapeBreakLines($string)
	{
		$string = str_replace ( "\n", "\\n", $string );
		return $string;
	}
	
	public static function encodeUTF8($dados)
	{
		if (is_array ( $dados ))
		{
			foreach ( $dados as $key => $value )
			{
				if (is_array ( $value ))
				{
					$new [$key] = self::encodeUTF8 ( $value );
				} else
				{
					$new [$key] = utf8_encode ( $value );
				}
			}
			$dados = $new;
			unset ( $new );
		} else
		{
			$dados = utf8_encode ( $dados );
		}
		return $dados;
	}
	
	public static function decodeUTF8($dados)
	{
		if (is_array ( $dados ))
		{
			foreach ( $dados as $key => $value )
			{
				if (is_array ( $value ))
				{
					$new [$key] = self::decodeUTF8 ( $value );
				} else
				{
					$new [$key] = utf8_decode ( $value );
				}
			}
			$dados = $new;
			unset ( $new );
		} else
		{
			$dados = utf8_decode ( $dados );
		}
		return $dados;
	}
	
	public function truncString($string, $numMaxChar)
	{
		$numChar = strlen ( $string );
		
		if ($numChar > $numMaxChar)
		{
			$aux = substr ( $string, 0, $numMaxChar - 3 );
			$string = $aux . "...";
		}
		return $string;
	}
	
	public static function friend_url($var)
	{
		$var = html_entity_decode ( $var );
		$var = strtolower ( stripslashes ( $var ) );
		$var = str_replace ( "[", "", $var );
		$var = str_replace ( "]", "", $var );
		$var = str_replace ( "{", "", $var );
		$var = str_replace ( "}", "", $var );
		$var = str_replace ( "(", "", $var );
		$var = str_replace ( ")", "", $var );
		$var = str_replace ( "*", "", $var );
		$var = str_replace ( "|", "", $var );
		$var = str_replace ( "+", "", $var );
		$var = str_replace ( "=", "", $var );
		$var = ereg_replace ( "[áàâãªäÁÀÂÃÄ]", "a", $var );
		$var = ereg_replace ( "[éèêëÉÈÊË]", "e", $var );
		$var = ereg_replace ( "[óòôõºöÓÒÔÕºÖ]", "o", $var );
		$var = ereg_replace ( "[úùûüÚÙÛÜ]", "u", $var );
		$var = ereg_replace ( "[íìîÍÌÎ]", "i", $var );
		$var = ereg_replace ( "[\,.;:?/°~^´`/!\"'@#$%¨&]", "", $var );
		$var = ereg_replace ( "[çÇ]", "c", $var );
		$var = ereg_replace ( "[ñÑ]", "n", $var );
		$var = str_replace ( " ", "-", $var );
		
		return $var;
	}
	
	public static function isFlash($strArquivo)
	{
		$ext = explode ( ".", $strArquivo );
		
		if ($ext [1] == "swf")
		{
			return true;
		} else
		{
			return false;
		}
	}
}

?>