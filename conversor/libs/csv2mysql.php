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

		include "banco.php";
		include "base.php";

		function convertMaiuscula($palavra) {
			$cont = 0;
			$str_irrelevante = array("de", "da", "do", "das", "dos", "em", "no", "na", "nos", "nas", "que", "com", "um", "uma", "uns", "umas", "se", "mas", "para");
			$palavras = array();
			$palavra_up = array();
			$palavras = explode(' ',$palavra);
			foreach($palavras as $nome) {
				foreach($str_irrelevante as $preposicao) {
					if($preposicao == $nome) {
						$cont ++;
					}
				}
				if($cont == 0)
					$palavra_up[] = ucfirst($nome);
				$palavra = implode(' ', $palavra_up);
			}

			return $palavra;

		}
		
		//abri o arquivo funcionario.csv
		$handle = fopen($file, "r");

		if ($handle) {
			$array = explode("\n", fread($handle, filesize($file)));//separa por linhas e armazena em array

			$total_array = count($array);//numero de linhas

			$data = explode(",", $array[0]);//separa a primeira linha(cabecalho da tabela) por virgula e armazena em data

			if($data[0] == 'MAT' and $data[1] == 'NOME' and $data[2] == 'CARGO' and $data[3] == 'CIDADE' and $data[4] == 'RG' and $data[5] == 'PIS') {//verifica se o cabeçãlho é valido
				$i = 1;
				$erro = 1;
				while($i < $total_array - 1) {
					$data = explode(",", $array[$i]);

					$matricula = $data[0];
					$nome = convertMaiuscula($data[1]);
					$cargo = convertMaiuscula($data[2]);
					$cidade = convertMaiuscula($data[3]);
					$rg = $data[4];
					$pis = $data[5];
					$cpf = $data[6];

					//trata as cidades
					$query_cidade = mysql_query("select * from tbcampus where nome = '$cidade'");
					if(mysql_num_rows($query_cidade)) {
						$cidade = mysql_fetch_array($query_cidade);
						$id_cidade = $cidade[idCampus];
					}else {
						$query_cidade = mysql_query("insert into tbcampus(nome) value('$cidade')");
						$id_cidade = mysql_insert_id();
					}

					//trata os cargos
					$query_cargo = mysql_query("select * from tbcargo where nome = '$cargo'");
					if(mysql_num_rows($query_cargo)) {
						$cargo = mysql_fetch_array($query_cargo);
						$id_cargo = $cargo[idCargo];
					}else {
						$query_cargo = mysql_query("insert into tbcargo(nome) value('$cargo')");
						$id_cargo = mysql_insert_id();
					}

					//verifica se o funcionario já está cadastrado
					$query_find = mysql_query("select * from tbfuncionario where matricula = '$matricula'");

					if(mysql_num_rows($query_find) <= 0 ) {
						//insere o funcionario
						$query = mysql_query("insert into tbfuncionario(idCargo, idCampus, nome, cpf, matricula, rg, pis, status) values($id_cargo,$id_cidade,'$nome', '$cpf', '$matricula', '$rg', '$pis', 1)");
						if(!$query) {
							echo "<strong class='error'>Erro ao inserir o servidor com a matricula $matricula</strong>$VOLTAR_SISTEMA";
							$erro = 0;
						}
					}else {
						//atualiza o funcionario
						$query = mysql_query("update tbfuncionario set nome = '$nome',idCargo = '$id_cargo', idCampus = '$id_cidade', rg = '$rg',pis = '$pis', cpf = '$cpf' where matricula = '$matricula'");
						if(!$query) {
							echo "<strong class='error'>Erro ao atualizar o servidor com a matricula $matricula</strong>$VOLTAR_SISTEMA";
							$erro = 0;
						}
					}

					$i++;
				}

				if($erro) {//ñ ocorreu erro durante as inserções ou atualizações
					fclose($handle);

					rename("funcionarios/funcionarios.csv", "funcionarios/funcionarios_ok.csv");
					echo "<strong class='okr'>Lista de servidores atualizada com sucesso!</strong>$VOLTAR_SISTEMA";
				}
			}else { //cabecalho invalido
				echo "<strong class='error'>Arquivo inválido.</strong>$VOLTAR_SISTEMA";
			}
		}else { //erro na abertura do arquivo
			echo "<strong class='error'>Erro ao abrir o arquivo</strong>$VOLTAR_SISTEMA";
		}
		?>
	</body>
</html>