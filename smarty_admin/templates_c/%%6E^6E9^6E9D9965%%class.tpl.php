<?php /* Smarty version 2.6.12, created on 2011-11-30 20:26:50
         compiled from gerador/class.tpl */ ?>
<?php echo '<?php'; ?>

require_once 'classes/base/entidade/ObjectDB.class.php';

class <?php echo $this->_tpl_vars['class']; ?>
 extends ObjectDB
<?php echo ' { '; ?>

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
	private $<?php echo $this->_tpl_vars['field']['name']; ?>
;
<?php endforeach; endif; unset($_from); ?>
	
	function __construct()
	<?php echo '{'; ?>

		parent::__construct();
	<?php echo ' } '; ?>

	
	public static function getInfoTable()
	<?php echo ' { '; ?>

	<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
		$table['<?php echo $this->_tpl_vars['table']; ?>
'][] = "<?php echo $this->_tpl_vars['field']['name']; ?>
";		
	<?php endforeach; endif; unset($_from); ?>
		return $table;		
	<?php echo ' } '; ?>

	
	public static function getAttributesKey()
	<?php echo ' { '; ?>

		<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
			<?php if ($this->_tpl_vars['field']['key'] == '1'): ?>
				$key[] = "<?php echo $this->_tpl_vars['field']['name']; ?>
";	
			<?php endif; ?>		
		<?php endforeach; endif; unset($_from); ?>
				
		return $key;
	<?php echo ' } '; ?>

	
	final public static function getAttributeInc()
	<?php echo ' { '; ?>

		<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
			<?php if ($this->_tpl_vars['field']['auto'] == '1'): ?>
				return "<?php echo $this->_tpl_vars['field']['name']; ?>
";	
			<?php endif; ?>		
		<?php endforeach; endif; unset($_from); ?>
	<?php echo ' } '; ?>

	
	
	<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
	function set<?php echo $this->_tpl_vars['field']['method']; ?>
($<?php echo $this->_tpl_vars['field']['name']; ?>
)
	<?php echo ' { '; ?>

		<?php if ($this->_tpl_vars['field']['key'] == '1'): ?>
		$this->checkForUpdateHashKey();
		<?php endif; ?>
		self::checkModify( __FUNCTION__ );
		
		$this-><?php echo $this->_tpl_vars['field']['name']; ?>
 = $<?php echo $this->_tpl_vars['field']['name']; ?>
;
	<?php echo ' } '; ?>

	
	public function get<?php echo $this->_tpl_vars['field']['method']; ?>
()
	<?php echo ' { '; ?>

		return $this-><?php echo $this->_tpl_vars['field']['name']; ?>
;
	<?php echo ' } '; ?>

	<?php endforeach; endif; unset($_from); ?>
}

<?php echo '?>'; ?>