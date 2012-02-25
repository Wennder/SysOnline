<div class="icons">
    <ul>
        <li><span id="add"><a href="javascript:;" onclick="GestaoUsuarios.initCad()" title="Incluir Novo Usuário"><img src="{$smarty.const.HTTP_URL}imagem/admin/add_user.png" alt=""/>Incluir Novo</a></span></li>
        <li><span id="delete"><a href="javascript:;" onclick="GestaoUsuarios.execDel()" title="Deletar Usuário"><img src="{$smarty.const.HTTP_URL}imagem/admin/delete_user.png" alt=""/>Deletar Seleção</a></span></li>
        <li>
            <span id="busca">
                <a href="javascript:;" onclick="js.showSearchs()" title="Buscar"><img src="{$smarty.const.HTTP_URL}imagem/admin/lupa.png" alt=""/>Buscar</a>
            </span>
        </li>
    </ul>
</div>
<div id="search" style="display:none">
    <form action="" method="post" id="formListUsuario" onsubmit="GestaoUsuarios.execList(); return false">
        <input type="hidden" name="ACTION" value="ExecListUsuariosAction" />
        <fieldset>
            <legend>Busca de Usuários </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label for="formListUsuario_usuario">Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formListUsuario_usuario" type="text" class="text" name="usuario" title="Critérios: NOME, EMAIL ou LOGIN."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formListUsuario_auxField_usuario">Critérios: NOME, EMAIL ou LOGIN.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListUsuario_ordem" class="text" name="ordem" title="Representa o critério usado para ordenar os resultados." style="width: 210px;">
                        <option value="">Ordem</option>
                            {html_options options=$optionsOrdem}
                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListUsuario_sentido" class="text" name="sentido" class="field" title="Trata-se da forma como os resultados serão ordenados.">
                            <option value="">Sentido da busca</option>
				{html_options options=$optionsSentidoOrdem}
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
