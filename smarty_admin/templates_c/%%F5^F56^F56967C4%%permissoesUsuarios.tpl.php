<?php /* Smarty version 2.6.12, created on 2012-01-08 10:05:17
         compiled from usuarios/permissoesUsuarios.tpl */ ?>
<div class="fieldset">
    <h3 class="legend">Dados usuário</h3>
    <strong class="type">Nome:</strong> <em class="subtype"><?php echo $this->_tpl_vars['usuarioInfo']['nome']; ?>
</em><br/>
    <strong class="type">Email:</strong> <em class="subtype"><?php echo $this->_tpl_vars['usuarioInfo']['email']; ?>
</em>
</div>
<div class="fieldset">
    <h3 class="legend">Grupos</h3>
    <form id="formPermissaoGrupos" action="" method="post">
        <input type="hidden" name="ACTION" value="UpdateGruposAction" />
        <input type="hidden" name="formId" value="formPermissaoGrupos" />
        <input type="hidden" name="idUsuario" value="<?php echo $this->_tpl_vars['idUsuario']; ?>
" />
        <ul class="lista_permissao">
            <li class="border_li">
                <strong class="type">Grupos:</strong><em class="subtype">&nbsp;Módulo que gerencia os grupos de usuários</em>
                <ul class="lista_final">
                    <?php $_from = $this->_tpl_vars['grupos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['grupo']):
?>
                        <li> <?php if ($this->_tpl_vars['grupo']['permissao'] != ""): ?>
                            <?php $this->assign('checked', "checked=true"); ?>
                        <?php else: ?>
                            <?php $this->assign('checked', ""); ?>
                        <?php endif; ?>
                        <input name="grupos"  value="<?php echo $this->_tpl_vars['grupo']['idGrupo']; ?>
" <?php echo $this->_tpl_vars['checked']; ?>
  type="radio" title="<?php echo $this->_tpl_vars['grupo']['descricao']; ?>
" id="grupo_<?php echo $this->_tpl_vars['grupo']['idGrupo']; ?>
" />
                        <label for="grupo_<?php echo $this->_tpl_vars['grupo']['idGrupo']; ?>
" title="<?php echo $this->_tpl_vars['grupo']['descricao']; ?>
"> <?php echo $this->_tpl_vars['grupo']['nome']; ?>
 </label>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </li>
        </ul>
        <div class="clear"> </div>
        <div class="sub_conteudo">
            <input type="button" class="btnC" title="Salvar alterações nos grupos" value="Salvar" onclick="GestaoUsuarios.updateGrupos()" />
            &nbsp;
            <input type="button" class="btnC btnC_alert" onclick="this.form.reset()" title="Cancelar alterações nos grupos" value="Cancelar" />
        </div>
    </form>
</div>
<div class="fieldset">
    <h3 class="legend">Módulos</h3>
    <form id="formPermissaoModulos" action="" method="post">
        <input type="hidden" name="ACTION" value="UpdateFluxosAction" />
        <input type="hidden" name="formId" value="formPermissaoModulos" />
        <input type="hidden" name="idUsuario" value="<?php echo $this->_tpl_vars['idUsuario']; ?>
" />
        <ul class="lista_permissao">
            <?php $_from = $this->_tpl_vars['casosDeUso']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idCasoDeUso'] => $this->_tpl_vars['casoDeUso']):
?>
            <li class="border_li">
                <strong class="type"> <?php echo $this->_tpl_vars['casoDeUso']['nome']; ?>
:</strong><em class="subtype">&nbsp;<?php echo $this->_tpl_vars['casoDeUso']['descricao']; ?>
</em>
                <ul class="lista_final" id="lista_final<?php echo $this->_tpl_vars['casoDeUso']['idCasoDeUso']; ?>
">
                    <li class="all_selected">
                        <input onchange="js.checkUncheckAll(this)" id="checkall<?php echo $this->_tpl_vars['casoDeUso']['idCasoDeUso']; ?>
" name="checkall" type="checkbox" style="float:left"/>
                        <label class="lbl_ck">Selecionar/Deselecionar todos </label>
                    </li>
                    <?php $_from = $this->_tpl_vars['casoDeUso']['fluxos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fluxo']):
?>
                    <li class="format">
                        <?php if ($this->_tpl_vars['fluxo']['permissao'] != ""): ?>
                            <?php $this->assign('checked', "checked=true"); ?>
                        <?php else: ?>
                            <?php $this->assign('checked', ""); ?>
                        <?php endif; ?>
                        <input type="checkbox" name="fluxos[]" value="<?php echo $this->_tpl_vars['fluxo']['idFluxo']; ?>
" <?php echo $this->_tpl_vars['checked']; ?>
 class="no_border" title="<?php echo $this->_tpl_vars['fluxo']['descricao']; ?>
" id="fluxo_<?php echo $this->_tpl_vars['fluxo']['idFluxo']; ?>
" />
                        <label title="<?php echo $this->_tpl_vars['fluxo']['descricao']; ?>
" for="fluxo_<?php echo $this->_tpl_vars['fluxo']['idFluxo']; ?>
"> <?php echo $this->_tpl_vars['fluxo']['nome']; ?>
 </label>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
                <div class="clear"> </div>
            </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <div class="clear"> </div>
        <div class="sub_conteudo">
            <input type="button" class="btnC" title="Salvar alterações nos módulos" value="Salvar" onclick="GestaoUsuarios.updateFluxos()" />
            &nbsp;
            <input type="button" class="btnC btnC_alert" onclick="this.form.reset()" title="Cancelar alterações nos módulos" value="Cancelar" />
        </div>
    </form>
</div>