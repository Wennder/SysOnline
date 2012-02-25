<form action="" method="post" onSubmit="return false;" id="formPaginacao_{$sufixo}">
  {foreach from=$post item="valor" key="nome"}
  <input type="hidden" name="{$nome}" value="{$valor}" />
  {/foreach}
  <label for="paginas_{$sufixo}">Paginas:</label>
  <select size="1" name="pag" onChange="js.pagSubmit(this)" id="paginas_{$sufixo}">
    {html_options options=$arrayPags selected=$pagAtual}
  </select>
  &nbsp;
  {if $numPags > 1}
  {if $pagAtual > 1}
  <input type="button" class="btn" id="activeLeft" onClick="js.pagPrior(this)" title="Anterior"/>
  {else}
  <input type="button" class="btn" id="disabledLeft" disabled="disabled" title="Anterior"/>
  {/if}
   
  {if $pagAtual < $numPags}
  <input type="button" class="btn" id="activeRight" onClick="js.pagNext(this)" title="Próxima"/>
  {else}
  <input type="button" class="btn" id="disabledRight" disabled="disabled" title="Próximo"/>
  {/if}
  {/if}
</form>
