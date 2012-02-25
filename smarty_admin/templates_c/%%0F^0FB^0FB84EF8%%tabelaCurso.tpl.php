<?php /* Smarty version 2.6.12, created on 2011-11-24 23:47:29
         compiled from curso/tabelaCurso.tpl */ ?>
<form action="" method="post" id="formDelCurso">
    <input type="hidden" name="ACTION" value="ExecDelCursoAction" />
    <table id="tablelist" summary="Listagem" class="tablelist" border="0" cellpadding="0" cellspacing="0" width="99%">
        <thead>
            <tr id="list_fields">
                <th class="check" style="width:40px;"> <input id="checkall" title="Clique aqui para selecionar todos os itens" type="checkbox" onchange="js.checkAll()"/></th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php $_from = $this->_tpl_vars['arrayItens']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curso']):
?>
            <tr onmouseOver="js.collorTrHover()" class="trTable">
                <td class="lista"><input type="checkbox" name="idCurso[]" value="<?php echo $this->_tpl_vars['curso']['idCurso']; ?>
" id="item_<?php echo $this->_tpl_vars['curso']['idCurso']; ?>
"/>
                </td>
                <td class="lista left">
                    <label><?php echo $this->_tpl_vars['curso']['nome']; ?>
</label>
                    <a href="javascript:GestaoCurso.initEdit('<?php echo $this->_tpl_vars['curso']['idCurso']; ?>
');" title="Editar Curso">[Editar]</a>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
</form>
<div class="pagination" id="paginacao_list_curso">
    <?php echo $this->_tpl_vars['paginacao']; ?>

</div>
<p class="quant"><b><?php echo $this->_tpl_vars['retornados']; ?>
</b> itens encontrados de <b><?php echo $this->_tpl_vars['total']; ?>
</b> no total.</p>