<?php
require_once 'classes/base/entidade/ObjectDB.class.php';

class {$class} extends ObjectDB
{literal} { {/literal}
{foreach from=$fields item=field}
	private ${$field.name};
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
		return $table;		
	{literal} } {/literal}
	
	public static function getAttributesKey()
	{literal} { {/literal}
		{foreach from=$fields item=field}
			{if $field.key == "1"}
				$key[] = "{$field.name}";	
			{/if}		
		{/foreach}
				
		return $key;
	{literal} } {/literal}
	
	final public static function getAttributeInc()
	{literal} { {/literal}
		{foreach from=$fields item=field}
			{if $field.auto == "1"}
				return "{$field.name}";	
			{/if}		
		{/foreach}
	{literal} } {/literal}
	
	
	{foreach from=$fields item=field}
	function set{$field.method}(${$field.name})
	{literal} { {/literal}
		{if $field.key == "1"}
		$this->checkForUpdateHashKey();
		{/if}
		self::checkModify( __FUNCTION__ );
		
		$this->{$field.name} = ${$field.name};
	{literal} } {/literal}
	
	public function get{$field.method}()
	{literal} { {/literal}
		return $this->{$field.name};
	{literal} } {/literal}
	{/foreach}
}

?>