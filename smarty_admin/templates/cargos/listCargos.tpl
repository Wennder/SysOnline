<div class="icons">
    <ul>
        <li><span id="add"><a href="javascript:;" onclick="GestaoCargos.initCad()" title="Incluir Novo Cargo"><img src="{$smarty.const.HTTP_URL}imagem/admin/add_user.png" alt=""/>Incluir Novo</a></span></li>
        <li><span id="delete"><a href="javascript:;" onclick="GestaoCargos.execDel()" title="Deletar Cargos"><img src="{$smarty.const.HTTP_URL}imagem/admin/delete_user.png" alt=""/>Deletar Seleção</a></span></li>
        <li>
            <span id="busca">
                <a href="javascript:;" onclick="js.showSearchs()" title="Buscar"><img src="{$smarty.const.HTTP_URL}imagem/admin/lupa.png" alt=""/>Buscar</a>
            </span>
        </li>
    </ul>
</div>
<div id="search" style="display:none">
    <form action="" method="post" id="formListCargo" onsubmit="GestaoCargos.execList(); return false">
        <input type="hidden" name="ACTION" value="ExecListCargosAction" />
        <fieldset>
            <legend>Busca de Cargos </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label for="formListCargo_cargo">Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formListCargo_cargo" type="text" class="text" name="cargo" title="Critérios: NOME."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formListCargo_auxField_cargo">Critérios: NOME.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListCargo_ordem" class="text" name="ordem" title="Representa o critério usado para ordenar os resultados." style="width: 210px;">
                            <option value="">Ordem</option>
				{html_options options=$optionsOrdem}
                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListCargo_sentido" class="text" name="sentido" class="field" title="Trata-se da forma como os resultados serão ordenados.">
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
<div class="container_table" id="lista_cargos">
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
