<form action="" method="post" id="formDelCargos">
    <input type="hidden" name="ACTION" value="ExecDelCargosAction" />
    <table id="tablelist" summary="Listagem" class="tablelist" border="0" cellpadding="0" cellspacing="0" width="99%">
        <thead>
            <tr id="list_fields">
                <th class="check" style="width:40px;"> <input id="checkall" title="Clique aqui para selecionar todos os itens" type="checkbox" onchange="js.checkAll()"/></th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$arrayItens item=cargo}
            <tr onmouseOver="js.collorTrHover()" class="trTable">
                <td class="lista"><input type="checkbox" name="idCargos[]" value="{$cargo.idCargo}" id="item_{$cargo.idCargo}"/>
                </td>
                <td class="lista left">
                    <label>{$cargo.nome}</label>
                    <a href="javascript:GestaoCargos.initEdit('{$cargo.idCargo}');" title="Editar Cargo">[Editar]</a>
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</form>
<div class="pagination" id="paginacao_list_cargo">
    {$paginacao}
</div>
<p class="quant"><b>{$retornados}</b> itens encontrados de <b>{$total}</b> no total.</p>
