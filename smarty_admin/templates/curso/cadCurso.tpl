<div class="icons">
    <ul>
        <li><span id="save"><a href="javascript:;" id="formSaveCurso_submit" onclick="GestaoCurso.cadCurso(); return false" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoCurso.initList(); return false" title="Cancelar"><img src="{$smarty.const.HTTP_URL}imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>
<fieldset class="all">
    <legend>Cadastro de Curso</legend>
    <form action="" method="post" id="formSaveCurso" onsubmit="GestaoCurso.cadCurso(); return false">
        <input type="hidden" name="ACTION" value="{$actionForm}" />
        <input type="hidden" name="formId" value="formSaveCurso" />
        <input type="hidden" name="idCurso" value="{$curso.idCurso}" />
        <div class="field">
            <label for="formSaveCurso_nome" class="lbl">Nome:</label>
            <input id="formSaveCurso_nome" name="nome" type="text" class="input_text" value="{$curso.nome}" title="Digite um Nome para o curso"/>
            <span class="aux_field" id="formSaveCurso_auxField_nome">Digite um Nome para o curso</span>
        </div>
    </form>
    <script language="javascript" type="text/javascript">
            FormUtil.initForm('formSaveCurso');
    </script>
</fieldset>
<div class="icons">
    <span class="hide">
        <a onclick="js.hideMenu();" href="javascript:;" title="Esconder/Mostrar Menu">
            <span style="display:none">
                <<
            </span>
        </a>
    </span>
    <ul>
        <li><span id="save"><a href="javascript:;" onclick="GestaoCurso.cadCurso(); return false;" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoCurso.initList(); return false;" title="Cancelar"><img src="{$smarty.const.HTTP_URL}imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>