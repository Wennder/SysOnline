<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
    <head>
        <title>SysAudi - Visualizar/Imprimir processos</title>
        <link rel="stylesheet" type="text/css" href="{$smarty.const.HTTP_URL}css/admin/print.css"  media="print"/>
    </head>
    <body>
        <?php
        session_start();

        unset($_SESSION['report_header']);
        unset($_SESSION['report_values']);

        $conn = mysql_connect("localhost", "root", "") or die('Não foi possivel conectar ao banco de dados! Erro: ' . mysql_error());
        if ($conn) {
            mysql_select_db("dbauditoria", $conn);
        }

        $nome = (isset($_POST ['funcionario'])) ? ($_POST ['funcionario']) : ("");
        $cargo = (isset($_POST ['cargo'])) ? ($_POST ['cargo']) : ("");
        $campi = (isset($_POST ['campi'])) ? ($_POST ['campi']) : ("");

        $strWhere = "where 1=1";
        $strWhere .= ( !empty($nome)) ? (" and ((tbfuncionario.nome like '%{$nome}%') or (tbfuncionario.cpf like '%{$nome}%') or (tbfuncionario.matricula like '%{$nome}%') or (tbfuncionario.rg like '%{$nome}%') or (tbfuncionario.pis like '%{$nome}%'))") : ("");
        $strWhere .= ( !empty($cargo)) ? ("  and ((tbcargo.idCargo = {$cargo}))") : ("");
        $strWhere .= ( !empty($campi)) ? ("  and ((tbcampus.idCampus = {$campi}))") : ("");
        $strWhere .= " and (tbfuncionario.status != -1)";

        $filtro = "select tbfuncionario.nome, tbfuncionario.cpf, tbfuncionario.matricula, tbfuncionario.rg, tbfuncionario.pis, tbcampus.nome as campus, tbcargo.nome as cargo ";
        $filtro .= "from tbfuncionario ";
        $filtro .= "inner join tbcargo on tbcargo.idCargo = tbfuncionario.idCargo
		    inner join tbcampus on tbcampus.idCampus = tbfuncionario.idCampus ";
        $filtro .= $strWhere;

        $resultado = mysql_query($filtro);

        $_SESSION['report_header'] = array("Nome", "CPF", "Matricula", "RG", "PIS", "Campus", "Cargo");

        if ($resultado != "") {
            $i = 0;
            while ($linha = mysql_fetch_array($resultado)) {
                for ($j = 0; $j < 7; $j++) {
                    $_SESSION['report_values'][$i][$j] = $linha[mysql_field_name($resultado, $j)];
                }
                $i++;
            }
            echo "Arquivo gerado com sucesso!";
        }
        ?>
        <a href="../../../../../classes/modelo/admin/controle/admin/export_report.php?fn=report">Click para gerar o relatório</a>
    </body>
</html>