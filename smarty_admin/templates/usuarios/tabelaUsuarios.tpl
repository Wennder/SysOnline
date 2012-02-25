<form action="" method="post" id="formDelUsuarios">
    <input type="hidden" name="ACTION" value="ExecDelUsuariosAction" />
    <table id="tablelist" summary="Listagem" class="tablelist" border="0" cellpadding="0" cellspacing="0" width="99%">
        <thead>
            <tr id="list_fields">
                <th class="check" style="width:40px;"> <input id="checkall" title="Clique aqui para selecionar todos os itens" type="checkbox" onchange="js.checkAll()"/></th>
                <th>Nome</th>
                <th>Email</th>
                <th>Login</th>
                <th style="border-right:none;">&nbsp;&nbsp;Status&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$arrayItens item=usuario}
            <tr onmouseOver="js.collorTrHover()" class="trTable">
                <td class="lista"><input type="checkbox" name="idUsuarios[]" value="{$usuario.idUsuario}" id="item_{$usuario.idUsuario}"/>
                </td>
                <td class="lista left">
                    <label>{$usuario.nome}</label>
                    <a href="javascript:GestaoUsuarios.initEdit('{$usuario.idUsuario}');" title="Editar Usuário">[Editar]</a>&nbsp;
                    <a href="javascript:GestaoUsuarios.gerenciaPermissoes('{$usuario.idUsuario}');" title="Editar Usuário">[Permissões]</a>
                </td>
                <td class="lista left">
                    <label>{$usuario.email}</label>
                </td>
                <td class="lista">
                    <label>{$usuario.login}</label>
                </td>
                <td class="lista">
                    {if $usuario.status == 1}
                        {assign var="imgStatus" value="ok"}
                            {assign var="labelStatus" value="Ativado --> Desativa-lo"}
                        {else}
                            {assign var="imgStatus" value="disable"}
                        {assign var="labelStatus" value="Desativado --> Ativa-lo"}
                    {/if}
                    <label><a onClick="" href="javascript:GestaoUsuarios.mudaStatus({$usuario.idUsuario}, {$usuario.status})" title="{$labelStatus}"><img onClick="js.imgChange(this, 'GestaoUsuarios.mudaStatus', {$usuario.idUsuario})" src="{$smarty.const.HTTP_URL}imagem/admin/{$imgStatus}.png" alt="{$labelStatus}"/></a></label>
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</form>
<div class="pagination" id="paginacao_list_usuario">
    {$paginacao}
</div>
<p class="quant"><b>{$retornados}</b> itens encontrados de <b>{$total}</b> no total.</p>
