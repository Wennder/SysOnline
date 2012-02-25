{strip}
<ul>
  {foreach from=$listaItens item=item}
  <li id="{$item.value}">
    {$item.label}
  </li>
  {/foreach}
</ul>
{/strip}
