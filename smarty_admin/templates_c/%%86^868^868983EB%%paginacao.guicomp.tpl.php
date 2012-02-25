<?php /* Smarty version 2.6.12, created on 2011-11-24 23:47:29
         compiled from base_comp/paginacao.guicomp.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'base_comp/paginacao.guicomp.tpl', 7, false),)), $this); ?>
<form action="" method="post" onSubmit="return false;" id="formPaginacao_<?php echo $this->_tpl_vars['sufixo']; ?>
">
  <?php $_from = $this->_tpl_vars['post']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nome'] => $this->_tpl_vars['valor']):
?>
  <input type="hidden" name="<?php echo $this->_tpl_vars['nome']; ?>
" value="<?php echo $this->_tpl_vars['valor']; ?>
" />
  <?php endforeach; endif; unset($_from); ?>
  <label for="paginas_<?php echo $this->_tpl_vars['sufixo']; ?>
">Paginas:</label>
  <select size="1" name="pag" onChange="js.pagSubmit(this)" id="paginas_<?php echo $this->_tpl_vars['sufixo']; ?>
">
    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrayPags'],'selected' => $this->_tpl_vars['pagAtual']), $this);?>

  </select>
  &nbsp;
  <?php if ($this->_tpl_vars['numPags'] > 1): ?>
  <?php if ($this->_tpl_vars['pagAtual'] > 1): ?>
  <input type="button" class="btn" id="activeLeft" onClick="js.pagPrior(this)" title="Anterior"/>
  <?php else: ?>
  <input type="button" class="btn" id="disabledLeft" disabled="disabled" title="Anterior"/>
  <?php endif; ?>
   
  <?php if ($this->_tpl_vars['pagAtual'] < $this->_tpl_vars['numPags']): ?>
  <input type="button" class="btn" id="activeRight" onClick="js.pagNext(this)" title="Próxima"/>
  <?php else: ?>
  <input type="button" class="btn" id="disabledRight" disabled="disabled" title="Próximo"/>
  <?php endif; ?>
  <?php endif; ?>
</form>