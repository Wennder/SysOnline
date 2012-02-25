<?php /* Smarty version 2.6.12, created on 2012-01-08 10:04:50
         compiled from usuarios/listUsuarios.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'usuarios/listUsuarios.tpl', 34, false),)), $this); ?>
<div class="icons">
    <ul>
        <li><span id="add"><a href="javascript:;" onclick="GestaoUsuarios.initCad()" title="Incluir Novo Usu�rio"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/add_user.png" alt=""/>Incluir Novo</a></span></li>
        <li><span id="delete"><a href="javascript:;" onclick="GestaoUsuarios.execDel()" title="Deletar Usu�rio"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/delete_user.png" alt=""/>Deletar Sele��o</a></span></li>
        <li>
            <span id="busca">
                <a href="javascript:;" onclick="js.showSearchs()" title="Buscar"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/lupa.png" alt=""/>Buscar</a>
            </span>
        </li>
    </ul>
</div>
<div id="search" style="display:none">
    <form action="" method="post" id="formListUsuario" onsubmit="GestaoUsuarios.execList(); return false">
        <input type="hidden" name="ACTION" value="ExecListUsuariosAction" />
        <fieldset>
            <legend>Busca de Usu�rios </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label for="formListUsuario_usuario">Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formListUsuario_usuario" type="text" class="text" name="usuario" title="Crit�rios: NOME, EMAIL ou LOGIN."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formListUsuario_auxField_usuario">Crit�rios: NOME, EMAIL ou LOGIN.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListUsuario_ordem" class="text" name="ordem" title="Representa o crit�rio usado para ordenar os resultados." style="width: 210px;">
                        <option value="">Ordem</option>
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsOrdem']), $this);?>

                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListUsuario_sentido" class="text" name="sentido" class="field" title="Trata-se da forma como os resultados ser�o ordenados.">
                            <option value="">Sentido da busca</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['optionsSentidoOrdem']), $this);?>

                        </select>
                    </td>
                    <td><input type="submit" value="Buscar" class="submit"/></td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<div class="clear">
</div>
<div class="container_table" id="lista_usuarios">
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