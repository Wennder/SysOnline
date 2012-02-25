{if $dia == "1"}

<select name="dia{$sufixo}" size="1" id="{$idForm}_dia{$sufixo}" title="{$title}">
  {html_options options=$optionsDia selected=$diaSel}
</select>
/
{/if}
{if $mes == "1"}
<select name="mes{$sufixo}" size="1" id="{$idForm}_mes{$sufixo}" title="{$title}">
  {html_options options=$optionsMes selected=$mesSel}
</select>
/
{/if}
{if $ano == "1"}
<select name="ano{$sufixo}" size="1" id="{$idForm}_ano{$sufixo}" title="{$title}">
  {html_options options=$optionsAno selected=$anoSel}
</select>
{/if}
{if $hora == "1"}
-
<select name="hora{$sufixo}" size="1" id="{$idForm}_hora{$sufixo}" title="{$title}">
  {html_options options=$optionsHora selected=$horaSel}
</select>
:
{/if}
{if $min == "1"}
<select name="min{$sufixo}" size="1" id="{$idForm}_min{$sufixo}" title="{$title}">
  {html_options options=$optionsMin selected=$minSel}
</select>
{/if}
