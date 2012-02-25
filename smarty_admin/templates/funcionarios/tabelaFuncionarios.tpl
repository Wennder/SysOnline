<form action="" method="post" id="formDelFuncionarios">
    <input type="hidden" name="ACTION" value="ExecDelFuncionariosAction" />
    <table id="tablelist" summary="Listagem" class="tablelist" border="0" cellpadding="0" cellspacing="0" width="99%">
        <thead>
            <tr id="list_fields">
                <th class="check" style="width:40px;"> <input id="checkall" title="Clique aqui para selecionar todos os itens" type="checkbox" onchange="js.checkAll()"/></th>
                <th>Nome/RG/CPF</th>
                <th>Matrícula</th>
                <th>Pis</th>
                <th>Cargo</th>
                <th>Campus</th>
                <th style="border-right:none;">&nbsp;&nbsp;Status&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$arrayItens item=funcionario}
            <tr onmouseOver="js.collorTrHover()" class="trTable">
                <td class="lista"><input type="checkbox" name="idFuncionarios[]" value="{$funcionario.idFuncionario}" id="item_{$funcionario.idFuncionario}"/>
                </td>
                <td class="lista left">
                    <label>
                        <b>Nome:</b> {$funcionario.nome}<br/>
                        <b>RG:</b> {$funcionario.rg}<br/>
                        <b>CPF:</b> {$funcionario.cpf}<br/>
                    </label>
                    <a href="javascript:GestaoFuncionarios.initEdit('{$funcionario.idFuncionario}');" title="Editar Funcionário">[Editar]</a>
                </td>
                <td class="lista">
                    <label>{$funcionario.matricula}</label>
                </td>
                <td class="lista">
                    <label>{$funcionario.pis}</label>
                </td>
                <td class="lista">
                    <label>{$funcionario.cargo}</label>
                </td>
                <td class="lista">
                    <label>{$funcionario.campus}</label>
                </td>
                <td class="lista">
                    {if $funcionario.status == 1}
                        {assign var="imgStatus" value="ok"}
                            {assign var="labelStatus" value="Ativado --> Desativa-lo"}
                        {else}
                            {assign var="imgStatus" value="disable"}
                        {assign var="labelStatus" value="Desativado --> Ativa-lo"}
                    {/if}
                    <label><a onClick="" href="javascript:GestaoFuncionarios.mudaStatus({$funcionario.idFuncionario}, {$funcionario.status})" title="{$labelStatus}"><img onClick="js.imgChange(this, 'GestaoFuncionarios.mudaStatus', {$funcionario.idFuncionario})" src="{$smarty.const.HTTP_URL}imagem/admin/{$imgStatus}.png" alt="{$labelStatus}"/></a></label>
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</form>
<div class="pagination" id="paginacao_list_funcionario">
    {$paginacao}
</div>
<p class="quant"><b>{$retornados}</b> itens encontrados de <b>{$total}</b> no total.</p>
