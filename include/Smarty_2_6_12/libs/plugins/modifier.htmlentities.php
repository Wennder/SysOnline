<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty htmlentities modifier plugin
 *
 * Type:     modifier<br>
 * Name:     htmlentities<br>
 * Purpose:  Convert all applicable characters to HTML entities 
 * @author   Jackson Cereb <jackson dot cereb at yahoo dot com dot br>
 * @param string
 * @return string
 */
function smarty_modifier_htmlentities($string)
{
    return htmlentities($string);
}

?>