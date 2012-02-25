<?php

interface ObjectPersistent
{
	public function save(&$obj);
	
	public function load(&$obj);
	
	public function update(&$obj);
	
	public function delete(&$obj);
	
	public function fromArray($array, &$obj);
	
	public function toArray(&$obj);
}

?>