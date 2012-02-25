<?php
require_once ("../../include/initialize.php");
require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/persistencia/DatabaseConnectionFactory.class.php';
require_once 'classes/base/sistema/Util.class.php';

set_time_limit ( 0 );

$dbConn = DatabaseConnectionFactory::getDefaultConnection ();

$sql = "select * from tbemail";

$dbRes = $dbConn->query ( $sql );

$itens = $dbRes->getAllResult ();

unset ( $dbRes );

$k = 0;

foreach ( $itens as $email )
{
	$eA = $email ['email'];
	$e = $email ['email'];
	
	$e = trim ( $e );
	$e = strtolower ( $e );
	$e = str_replace ( "&quot", "", $e );
	$e = Util::clearLines ( $e );
	$e = (Seguranca::emailIsValido ( $e )) ? $e : '';
	
	if (! empty ( $e ))
	{
		if ($e != $eA)
		{
			try
			{
				$sql = "update tbemail set email = '{$e}' where email = '{$eA}'";
				$dbConn->query ( $sql );
				$k ++;
			} catch ( Exception $e )
			{
				echo Util::debugVar ( $sql );
				echo Util::debugVar ( $e );
			}
		}
	} else
	{
		$sql = "delete from tbemail where email = '{$eA}'";
		$dbConn->query ( $sql );
	}
}

echo "Total: " . count ( $itens ) . "<br />\n";
echo "Ajustados: " . $k . "<br />\n";

?>