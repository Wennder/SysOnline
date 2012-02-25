<div class="icons">
    <ul>
        <li><span id="add"><a href="javascript:;" onclick="GestaoCurso.initCad()" title="Incluir Novo Curso"><img src="{$smarty.const.HTTP_URL}imagem/admin/add_user.png" alt=""/>Incluir Novo</a></span></li>
        <li><span id="delete"><a href="javascript:;" onclick="GestaoCurso.execDel()" title="Deletar Curso"><img src="{$smarty.const.HTTP_URL}imagem/admin/delete_user.png" alt=""/>Deletar Seleção</a></span></li>
        <li>
            <span id="busca">
                <a href="javascript:;" onclick="js.showSearchs()" title="Buscar"><img src="{$smarty.const.HTTP_URL}imagem/admin/lupa.png" alt=""/>Buscar</a>
            </span>
        </li>
    </ul>
</div>
<div id="search" style="display:none">
    <form action="" method="post" id="formListCurso" onsubmit="GestaoCurso.execList(); return false">
        <input type="hidden" name="ACTION" value="ExecListCursoAction" />
        <fieldset>
            <legend>Busca de Curso </legend>
            <table class="container_busca" align="center">
                <tr>
                    <td><label for="formListCurso_curso">Pesquisar por:</label></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input id="formListCurso_curso" type="text" class="text" name="curso" title="Critérios: NOME."/>
                    </td>
                    <td><span class="aux_fieldInTable" id="formListCurso_auxField_curso">Critérios: NOME.</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <select size="1" id="formListCurso_ordem" class="text" name="ordem" title="Representa o critério usado para ordenar os resultados." style="width: 210px;">
                            <option value="">Ordem</option>
				{html_options options=$optionsOrdem}
                        </select><br/>
                    </td>
                    <td>
                        <select size="1" id="formListCurso_sentido" class="text" name="sentido" class="field" title="Trata-se da forma como os resultados serão ordenados.">
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
<div class="container_table" id="lista_curso">
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
