<?php /* Smarty version 2.6.12, created on 2011-11-30 01:18:20
         compiled from funcionarios/listFuncionarios.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'funcionarios/listFuncionarios.tpl', 39, false),)), $this); ?>
<div class="icons">
    <ul>
        <li><span id="add"><a href="javascript:;" onclick="GestaoFuncionarios.initCad()" title="Incluir Novo Funcionário"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/add_user.png" alt=""/>Incluir Novo</a></span></li>
        <li><span id="delete"><a href="javascript:;" onclick="GestaoFuncionarios.execDel()" title="Deletar Funcionários"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/delete_user.png" alt=""/>Deletar Seleção</a></span></li>
        <li>
            <span id="busca">
                <a href="javascript:;" onclick="js.showSearchs()" title="Buscar"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/lupa.png" alt=""/>Buscar</a>
            </span>
        </li>
        <li>
            <span id="relatorio">
                <a href="javascript:;" onclick="js.showReports()" title="Gerar relatório"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/tableExcel.png" alt=""/>Gerar relatórios</a>
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
                        <input id="formListFuncionario_funcionario" type="text" class="text" name="funcionario" title="Critérios: NOME, CPF, MATRÍCULA, RG, PIS."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formListFuncionario_auxField_funcionario">Critérios: NOME, CPF, MATRÍCULA, RG, PIS.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListFuncionario_cargo" class="text" name="cargo" title="Representa o cargo do funcionário" style="width: 210px;">
                            <option value="">Selecione o cargo</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsCargo']), $this);?>

                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListFuncionario_campi" class="text" name="campi" title="Representa o campi do funcionário">
                            <option value="">Selecione o campus</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsCampi']), $this);?>

                        </select>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListFuncionario_ordem" class="text" name="ordem" title="Representa o critério usado para ordenar os resultados." style="width: 210px;">
                            <option value="">Ordem</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsOrdem']), $this);?>

                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListFuncionario_sentido" class="text" name="sentido" title="Trata-se da forma como os resultados serão ordenados.">
                            <option value="">Sentido da busca</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsSentidoOrdem']), $this);?>

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
            <legend>Relatório de Funcionários </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label>Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formReportsFuncionario_funcionario" type="text" class="text" name="funcionario" title="Critérios: NOME, CPF, MATRÍCULA, RG, PIS."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formReportsFuncionario_auxField_funcionario">Critérios: NOME, CPF, MATRÍCULA, RG, PIS.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formReportsFuncionario_cargo" class="text" name="cargo" title="Representa o cargo do funcionário" style="width: 210px;">
                            <option value="">Selecione o cargo</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsCargo']), $this);?>

                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formReportsFuncionario_campi" class="text" name="campi" title="Representa o campi do funcionário">
                            <option value="">Selecione o campus</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsCampi']), $this);?>

                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Gerar relatório" class="submit" style="width: 110px;"/></td>
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