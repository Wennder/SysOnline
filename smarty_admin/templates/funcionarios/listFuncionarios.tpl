<div class="icons">
    <ul>
        <li><span id="add"><a href="javascript:;" onclick="GestaoFuncionarios.initCad()" title="Incluir Novo Funcion�rio"><img src="{$smarty.const.HTTP_URL}imagem/admin/add_user.png" alt=""/>Incluir Novo</a></span></li>
        <li><span id="delete"><a href="javascript:;" onclick="GestaoFuncionarios.execDel()" title="Deletar Funcion�rios"><img src="{$smarty.const.HTTP_URL}imagem/admin/delete_user.png" alt=""/>Deletar Sele��o</a></span></li>
        <li>
            <span id="busca">
                <a href="javascript:;" onclick="js.showSearchs()" title="Buscar"><img src="{$smarty.const.HTTP_URL}imagem/admin/lupa.png" alt=""/>Buscar</a>
            </span>
        </li>
        <li>
            <span id="relatorio">
                <a href="javascript:;" onclick="js.showReports()" title="Gerar relat�rio"><img src="{$smarty.const.HTTP_URL}imagem/admin/tableExcel.png" alt=""/>Gerar relat�rios</a>
            </span>
        </li>
    </ul>
</div>
<div id="search" style="display:none">
    <form action="" target="_blank" method="post" id="formListFuncionario" onsubmit="GestaoFuncionarios.execList(); return false">
        <input type="hidden" name="ACTION" value="ExecListFuncionariosAction" />
        <fieldset>
            <legend>Busca de Funcionarios </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label for="formListFuncionario_funcionario">Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formListFuncionario_funcionario" type="text" class="text" name="funcionario" title="Crit�rios: NOME, CPF, MATR�CULA, RG, PIS."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formListFuncionario_auxField_funcionario">Crit�rios: NOME, CPF, MATR�CULA, RG, PIS.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListFuncionario_cargo" class="text" name="cargo" title="Representa o cargo do funcion�rio" style="width: 210px;">
                            <option value="">Selecione o cargo</option>
				{html_options options=$optionsCargo}
                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListFuncionario_campi" class="text" name="campi" title="Representa o campi do funcion�rio">
                            <option value="">Selecione o campus</option>
				{html_options options=$optionsCampi}
                        </select>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListFuncionario_ordem" class="text" name="ordem" title="Representa o crit�rio usado para ordenar os resultados." style="width: 210px;">
                            <option value="">Ordem</option>
				{html_options options=$optionsOrdem}
                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListFuncionario_sentido" class="text" name="sentido" title="Trata-se da forma como os resultados ser�o ordenados.">
                            <option value="">Sentido da busca</option>
				{html_options options=$optionsSentidoOrdem}
                        </select>
                    </td>
                    <td><input type="button" value="Buscar" class="submit"/></td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<div id="reports" style="display:none">
    <form action="../../classes/modelo/admin/controle/funcionarios/getterReportsFuncionario.php" id="formReportsFuncionario" target="_blank" method="post">
        <fieldset>
            <legend>Relat�rio de Funcion�rios </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label>Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formReportsFuncionario_funcionario" type="text" class="text" name="funcionario" title="Crit�rios: NOME, CPF, MATR�CULA, RG, PIS."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formReportsFuncionario_auxField_funcionario">Crit�rios: NOME, CPF, MATR�CULA, RG, PIS.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formReportsFuncionario_cargo" class="text" name="cargo" title="Representa o cargo do funcion�rio" style="width: 210px;">
                            <option value="">Selecione o cargo</option>
				{html_options options=$optionsCargo}
                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formReportsFuncionario_campi" class="text" name="campi" title="Representa o campi do funcion�rio">
                            <option value="">Selecione o campus</option>
				{html_options options=$optionsCampi}
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Gerar relat�rio" class="submit" style="width: 110px;"/></td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<div class="clear">
</div>
<div class="container_table" id="lista_funcionarios">
</div>
<div class="icons">
    <span class="hide">
        <a onclick="js.hideMenu();" href="javascript:;" title="Esconder/Mostrar Menu">
            <span style="display:none">
                <<
            </span>
        </a>
    </span>
</div>
