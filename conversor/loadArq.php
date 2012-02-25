<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
		<title>SysAudi - Conversor</title>
		<style type="text/css">
			.error {display: block;font: bold 13px tahoma;color: #f00;}
			.okr {display: block;font: bold 13px tahoma;color: #018F00;}
			span a {display: block;font: bold 12px tahoma;color: #06f;text-decoration: underline;}
		</style>
	</head>
	<body>

		<?php
		include "libs/base.php";

		$uploaddir = 'funcionarios/';

		$uploadfile = $uploaddir . $_FILES['arq']['name'];

		if (move_uploaded_file($_FILES['arq']['tmp_name'], $uploadfile)) {
			$file = "funcionarios/funcionarios.csv";
			include "libs/csv2mysql.php";
		}else {
			echo "<strong class='error'>Houve um erro no upload do arquivo</strong>$VOLTAR_SISTEMA";
		}
		?>
	</body>
</html>



