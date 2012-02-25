<?php /* Smarty version 2.6.12, created on 2011-11-25 09:15:36
         compiled from cargos/cadCargo.tpl */ ?>
<div class="icons">
    <ul>
        <li><span id="save"><a href="javascript:;" id="formSaveCargo_submit" onclick="GestaoCargos.cadCargo(); return false" title="Salvar"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoCargos.initList(); return false" title="Cancelar"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>
<fieldset class="all">
    <legend>Cadastro de Cargos</legend>
    <form action="" method="post" id="formSaveCargo" onsubmit="GestaoCargos.cadCargo(); return false">
        <input type="hidden" name="ACTION" value="<?php echo $this->_tpl_vars['actionForm']; ?>
" />
        <input type="hidden" name="formId" value="formSaveCargo" />
        <input type="hidden" name="idCargo" value="<?php echo $this->_tpl_vars['cargo']['idCargo']; ?>
" />
        <div class="field">
            <label for="formSaveCargo_nome" class="lbl">Nome:</label>
            <input id="formSaveCargo_nome" name="nome" type="text" class="input_text" value="<?php echo $this->_tpl_vars['cargo']['nome']; ?>
" title="Digite um Nome para o cargo"/>
            <span class="aux_field" id="formSaveCargo_auxField_nome">Digite um Nome para o cargo</span>
        </div>
    </form>
    <script language="javascript" type="text/javascript">
            FormUtil.initForm('formSaveCargo');
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
        <li><span id="save"><a href="javascript:;" onclick="GestaoCargos.cadCargo(); return false;" title="Salvar"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoCargos.initList(); return false;" title="Cancelar"><img src="<?php echo @HTTP_URL; ?>
imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>