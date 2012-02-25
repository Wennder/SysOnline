<form action="" method="post" id="formDelCampi">
    <input type="hidden" name="ACTION" value="ExecDelCampiAction" />
    <table id="tablelist" summary="Listagem" class="tablelist" border="0" cellpadding="0" cellspacing="0" width="99%">
        <thead>
            <tr id="list_fields">
                <th class="check" style="width:40px;"> <input id="checkall" title="Clique aqui para selecionar todos os itens" type="checkbox" onchange="js.checkAll()"/></th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$arrayItens item=campus}
            <tr onmouseOver="js.collorTrHover()" class="trTable">
                <td class="lista"><input type="checkbox" name="idCampi[]" value="{$campus.idCampus}" id="item_{$campus.idCampus}"/>
                </td>
                <td class="lista left">
                    <label>{$campus.nome}</label>
                    <a href="javascript:GestaoCampi.initEdit('{$campus.idCampus}');" title="Editar Campus">[Editar]</a>
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</form>
<div class="pagination" id="paginacao_list_campus">
    {$paginacao}
</div>
<p class="quant"><b>{$retornados}</b> itens encontrados de <b>{$total}</b> no total.</p>
