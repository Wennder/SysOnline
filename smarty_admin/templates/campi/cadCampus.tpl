<div class="icons">
    <ul>
        <li><span id="save"><a href="javascript:;" id="formSaveCampus_submit" onclick="GestaoCampi.cadCampus(); return false" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoCampi.initList(); return false" title="Cancelar"><img src="{$smarty.const.HTTP_URL}imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>
<fieldset class="all">
    <legend>Cadastro de Campi</legend>
    <form action="" method="post" id="formSaveCampus" onsubmit="GestaoCampi.cadCampus(); return false">
        <input type="hidden" name="ACTION" value="{$actionForm}" />
        <input type="hidden" name="formId" value="formSaveCampus" />
        <input type="hidden" name="idCampus" value="{$campus.idCampus}" />
        <div class="field">
            <label for="formSaveCampus_nome" class="lbl">Nome:</label>
            <input id="formSaveCampus_nome" name="nome" type="text" class="input_text" value="{$campus.nome}" title="Digite um Nome para o campus"/>
            <span class="aux_field" id="formSaveCampus_auxField_nome">Digite um Nome para o campus</span>
        </div>
    </form>
    <script language="javascript" type="text/javascript">
            FormUtil.initForm('formSaveCampus');
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
        <li><span id="save"><a href="javascript:;" onclick="GestaoCampi.cadCampus(); return false" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoCampi.initList(); return false" title="Cancelar"><img src="{$smarty.const.HTTP_URL}imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>