<div class="icons">
    <ul>
        <li><span id="add"><a href="javascript:;" onclick="GestaoCampi.initCad()" title="Incluir Novo Campus"><img src="{$smarty.const.HTTP_URL}imagem/admin/add_user.png" alt=""/>Incluir Novo</a></span></li>
        <li><span id="delete"><a href="javascript:;" onclick="GestaoCampi.execDel()" title="Deletar Campus"><img src="{$smarty.const.HTTP_URL}imagem/admin/delete_user.png" alt=""/>Deletar Seleção</a></span></li>
        <li>
            <span id="busca">
                <a href="javascript:;" onclick="js.showSearchs()" title="Buscar"><img src="{$smarty.const.HTTP_URL}imagem/admin/lupa.png" alt=""/>Buscar</a>
            </span>
        </li>
    </ul>
</div>
<div id="search" style="display:none">
    <form action="" method="post" id="formListCampus" onsubmit="GestaoCampi.execList(); return false">
        <input type="hidden" name="ACTION" value="ExecListCampiAction" />
        <fieldset>
            <legend>Busca de Campi </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label for="formListCampus_campus">Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formListCampus_campus" type="text" class="text" name="campus" title="Critérios: NOME."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formListCampus_auxField_campus">Critérios: NOME.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListCampus_ordem" class="text" name="ordem" title="Representa o critério usado para ordenar os resultados." style="width: 210px;">
                            <option value="">Ordem</option>
				{html_options options=$optionsOrdem}
                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListCampus_sentido" class="text" name="sentido" class="field" title="Trata-se da forma como os resultados serão ordenados.">
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
<div class="container_table" id="lista_campi">
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
