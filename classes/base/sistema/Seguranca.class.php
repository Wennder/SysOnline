<?php

/**
 * Classe com métodos úteis relacionados à segurança
 *
 */
class Seguranca
{
	private static function PADRAO_INJECTION()
	{
		$injection = "( select | insert | update | delete | drop | alter | create | table | tables |0x| desc | inner | left | outer | join | group | order | limit |\*|--)";
		return $injection;
	}
	
	//@todo refazer padrao
	//@todo refazer padrao
	private function PADRAO_LOGIN()
	{
		$login = "/^([a-z,A-Z,0-9]+)([.,_,-]*)([a-z,A-Z,0-9]+$)/";
		return $login;
	}

	private static function PADRAO_SENHA()
	{
		$senha = "/^([a-z,A-Z,0-9,_]+)([a-z,A-Z,0-9,_]{5,}$)/";
		return $senha;
	}

	private static function PADRAO_EMAIL()
	{
		$email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/";
		return $email;
	}

	private static function PADRAO_ARQUIVO()
	{
		$arquivo = "/^[a-z,A-Z,0-9,\_,\-,\.]+\.[a-z,A-Z,0-9]+$/";
		return $arquivo;
	}
	
	private static function SALT_KEY_HASH()
	{
		return "f20009251ef3d8eecb9c3493306d244ace1eec48";
	}
	
	private static function SALT_SENHA()
	{
		return "54456SDF48WE2W545SD4554fw856we452e421s2d";
	}
	
	public static function createSenha($str)
	{
		return sha1 ( sha1 ( self::SALT_SENHA () ) . sha1 ( $str ) . sha1 ( self::SALT_SENHA () ) );
	}
	
	public static function clear($dados)
	{
		if (is_array ( $dados ))
		{
			$new = array ();
			foreach ( $dados as $key => $value )
			{
				if (is_array ( $value ))
				{
					$new [$key] = self::clear ( $value );
				} else
				{
					$new [$key] = self::clearSimples ( $value );
				}
			}
			$dados = $new;
			unset ( $new );
		} else
		{
			$dados = self::clearSimples ( $dados );
		}
		
		return $dados;
	}
	
	public static function clearSQLInjection($string)
	{
		$string = preg_replace ( self::PADRAO_INJECTION (), "", $string );
		return $string;
	}
	
	public static function clearTagsSimples($string)
	{
		$string = str_replace ( "<", "", $string );
		$string = str_replace ( ">", "", $string );
		
		return strip_tags ( $string );
	}
	
	public static function clearTags($dados)
	{
		if (is_array ( $dados ))
		{
			$new = array ();
			foreach ( $dados as $key => $value )
			{
				if (is_array ( $value ))
				{
					$new [$key] = self::clearTags ( $value );
				} else
				{
					$new [$key] = self::clearTagsSimples ( $value );
				}
			}
			$dados = $new;
			unset ( $new );
		} else
		{
			$dados = self::clearTagsSimples ( $dados );
		}
		
		return $dados;
	}
	
	public static function clearHTML($string)
	{
		return htmlentities ( $string );
	}
	
	public static function addslashes($string)
	{
		return addslashes ( $string );
	}
	
	public static function stripslashes($dados)
	{
		if (is_array ( $dados ))
		{
			$new = array ();
			foreach ( $dados as $key => $value )
			{
				if (is_array ( $value ))
				{
					$new [$key] = self::stripslashes ( $value );
				} else
				{
					//@todo 2 vezes não era para ser nescessário
					$new [$key] = stripslashes ( stripslashes ( $value ) );
				}
			}
			$dados = $new;
			unset ( $new );
		} elseif ($dados != null)
		{
			$dados = stripslashes ( stripslashes ( $dados ) );
		}
		
		return $dados;
	}
	
	public static function clearSimples($string)
	{
		$string = self::clearSQLInjection ( $string );
		$string = self::addslashes ( $string );
		$string = trim ( $string );
		
		return $string;
	}
	
	public static function loginIsValido($login)
	{
		return (preg_match ( self::PADRAO_LOGIN (), $login ) or preg_match ( self::PADRAO_EMAIL (), $login ));
	}
	
	public static function emailIsValido($email)
	{
		return preg_match ( self::PADRAO_EMAIL (), $email );
	}
	
	public static function senhaIsValida($senha)
	{
		return preg_match ( self::PADRAO_SENHA (), $senha );
	}
	
	public static function arquivoIsValido($arquivo)
	{
		return preg_match ( self::PADRAO_ARQUIVO (), $arquivo );
	}
	
	public static function createKeyHash($str)
	{
		return sha1 ( self::SALT_KEY_HASH () . $str . self::SALT_KEY_HASH () . $str . self::SALT_KEY_HASH () );
	}
	
	public static function compareKeyHash($str, $hashCompare)
	{
		$hash = self::createKeyHash ( $str );
		if ($hash === $hashCompare)
		{
			return true;
		} else
		{
			return false;
		}
	}
	
	public static function addHashKeyToArray(&$array, $campo)
	{
		if (count ( $array ) > 0)
		{
			$keys = array_keys ( $array );
			foreach ( $keys as $key )
			{
				$array [$key] ['hashKey'] = self::createKeyHash ( $array [$key] [$campo] );
			}
		}
	}

}

?>