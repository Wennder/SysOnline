<?php
require_once 'classes/modelo/entidade/{$pacote}/{$classParent}.class.php';

class {$class} extends {$classParent}
{literal} { {/literal}
{foreach from=$fields item=field}
	{if $field.key == "0"}
		private ${$field.name};
	{/if}
{/foreach}
	
	function __construct()
	{literal}{{/literal}
		parent::__construct();
	{literal} } {/literal}
	
	public static function getInfoTable()
	{literal} { {/literal}
	{foreach from=$fields item=field}
		$table['{$table}'][] = "{$field.name}";		
	{/foreach}
		
		$tableParent = parent::getInfoTable();		
		$result = array_merge( $tableParent, $table );
	
		return $result;		
	{literal} } {/literal}
			
	{foreach from=$fields item=field}
		{if $field.key == "0"}
			function set{$field.method}(${$field.name})
			{literal} { {/literal}			
				
				self::checkModify( __FUNCTION__ );
				
				$this->{$field.name} = ${$field.name};
			{literal} } {/literal}
			
			public function get{$field.method}()
			{literal} { {/literal}
				return $this->{$field.name};
			{literal} } {/literal}
		{/if}
	{/foreach}
}

?>