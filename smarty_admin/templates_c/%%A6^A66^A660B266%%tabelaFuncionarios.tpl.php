<?php /* Smarty version 2.6.12, created on 2011-11-30 01:18:21
         compiled from funcionarios/tabelaFuncionarios.tpl */ ?>
<form action="" method="post" id="formDelFuncionarios">
    <input type="hidden" name="ACTION" value="ExecDelFuncionariosAction" />
    <table id="tablelist" summary="Listagem" class="tablelist" border="0" cellpadding="0" cellspacing="0" width="99%">
        <thead>
            <tr id="list_fields">
                <th class="check" style="width:40px;"> <input id="checkall" title="Clique aqui para selecionar todos os itens" type="checkbox" onchange="js.checkAll()"/></th>
                <th>Nome/RG/CPF</th>
                <th>Matrícula</th>
                <th>Pis</th>
                <th>Cargo</th>
                <th>Campus</th>
                <th style="border-right:none;">&nbsp;&nbsp;Status&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php $_from = $this->_tpl_vars['arrayItens']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['funcionario']):
?>
            <tr onmouseOver="js.collorTrHover()" class="trTable">
                <td class="lista"><input type="checkbox" name="idFuncionarios[]" value="<?php echo $this->_tpl_vars['funcionario']['idFuncionario']; ?>
" id="item_<?php echo $this->_tpl_vars['funcionario']['idFuncionario']; ?>
"/>
                </td>
                <td class="lista left">
                    <label>
                        <b>Nome:</b> <?php echo $this->_tpl_vars['funcionario']['nome']; ?>
<br/>
                        <b>RG:</b> <?php echo $this->_tpl_vars['funcionario']['rg']; ?>
<br/>
                        <b>CPF:</b> <?php echo $this->_tpl_vars['funcionario']['cpf']; ?>
<br/>
                    </label>
                    <a href="javascript:GestaoFuncionarios.initEdit('<?php echo $this->_tpl_vars['funcionario']['idFuncionario']; ?>
');" title="Editar Funcionário">[Editar]</a>
                </td>
                <td class="lista">
                    <label><?php echo $this->_tpl_vars['funcionario']['matricula']; ?>
</label>
                </td>
                <td class="lista">
                    <label><?php echo $this->_tpl_vars['funcionario']['pis']; ?>
</label>
                </td>
                <td class="lista">
                    <label><?php echo $this->_tpl_vars['funcionario']['cargo']; ?>
</label>
                </td>
                <td class="lista">
                    <label><?php echo $this->_tpl_vars['funcionario']['campus']; ?>
</label>
                </td>
                <td class="lista">
                    <?php if ($this->_tpl_vars['funcionario']['status'] == 1): ?>
                        <?php $this->assign('imgStatus', 'ok'); ?>
                            <?php $this->assign('labelStatus', "Ativado --> Desativa-lo"); ?>
                        <?php else: ?>
                            <?php $this->assign('imgStatus', 'disable'); ?>
                        <?php $this->assign('labelStatus', "Desativado --> Ativa-lo"); ?>
                    <?php endif; ?>
                    <label><a onClick="" href="javascript:GestaoFuncionarios.mudaStatus(<?php echo $this->_tpl_vars['funcionario']['idFuncionario']; ?>
, <?php echo $this->_tpl_vars['funcionario']['status']; ?>
)" title="<?php echo $this->_tpl_vars['labelStatus']; ?>
"><img onClick="js.imgChange(this, 'GestaoFuncionarios.mudaStatus', <?php echo $this->_tpl_vars['funcionario']['idFuncionario']; ?>
)" src="<?php echo @HTTP_URL; ?>
imagem/admin/<?php echo $this->_tpl_vars['imgStatus']; ?>
.png" alt="<?php echo $this->_tpl_vars['labelStatus']; ?>
"/></a></label>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
</form>
<div class="pagination" id="paginacao_list_funcionario">
    <?php echo $this->_tpl_vars['paginacao']; ?>

</div>
<p class="quant"><b><?php echo $this->_tpl_vars['retornados']; ?>
</b> itens encontrados de <b><?php echo $this->_tpl_vars['total']; ?>
</b> no total.</p>