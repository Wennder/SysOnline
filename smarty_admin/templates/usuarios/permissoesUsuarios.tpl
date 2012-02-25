<div class="fieldset">
    <h3 class="legend">Dados usuário</h3>
    <strong class="type">Nome:</strong> <em class="subtype">{$usuarioInfo.nome}</em><br/>
    <strong class="type">Email:</strong> <em class="subtype">{$usuarioInfo.email}</em>
</div>
<div class="fieldset">
    <h3 class="legend">Grupos</h3>
    <form id="formPermissaoGrupos" action="" method="post">
        <input type="hidden" name="ACTION" value="UpdateGruposAction" />
        <input type="hidden" name="formId" value="formPermissaoGrupos" />
        <input type="hidden" name="idUsuario" value="{$idUsuario}" />
        <ul class="lista_permissao">
            <li class="border_li">
                <strong class="type">Grupos:</strong><em class="subtype">&nbsp;Módulo que gerencia os grupos de usuários</em>
                <ul class="lista_final">
                    {foreach from=$grupos item=grupo}
                        <li> {if $grupo.permissao != ""}
                            {assign var="checked" value="checked=true"}
                        {else}
                            {assign var="checked" value=""}
                        {/if}
                        <input name="grupos"  value="{$grupo.idGrupo}" {$checked}  type="radio" title="{$grupo.descricao}" id="grupo_{$grupo.idGrupo}" />
                        <label for="grupo_{$grupo.idGrupo}" title="{$grupo.descricao}"> {$grupo.nome} </label>
                        </li>
                    {/foreach}
                </ul>
            </li>
        </ul>
        <div class="clear"> </div>
        <div class="sub_conteudo">
            <input type="button" class="btnC" title="Salvar alterações nos grupos" value="Salvar" onclick="GestaoUsuarios.updateGrupos()" />
            &nbsp;
            <input type="button" class="btnC btnC_alert" onclick="this.form.reset()" title="Cancelar alterações nos grupos" value="Cancelar" />
        </div>
    </form>
</div>
<div class="fieldset">
    <h3 class="legend">Módulos</h3>
    <form id="formPermissaoModulos" action="" method="post">
        <input type="hidden" name="ACTION" value="UpdateFluxosAction" />
        <input type="hidden" name="formId" value="formPermissaoModulos" />
        <input type="hidden" name="idUsuario" value="{$idUsuario}" />
        <ul class="lista_permissao">
            {foreach from=$casosDeUso item=casoDeUso key=idCasoDeUso}
            <li class="border_li">
                <strong class="type"> {$casoDeUso.nome}:</strong><em class="subtype">&nbsp;{$casoDeUso.descricao}</em>
                <ul class="lista_final" id="lista_final{$casoDeUso.idCasoDeUso}">
                    <li class="all_selected">
                        <input onchange="js.checkUncheckAll(this)" id="checkall{$casoDeUso.idCasoDeUso}" name="checkall" type="checkbox" style="float:left"/>
                        <label class="lbl_ck">Selecionar/Deselecionar todos </label>
                    </li>
                    {foreach from=$casoDeUso.fluxos item=fluxo}
                    <li class="format">
                        {if $fluxo.permissao != ""}
                            {assign var="checked" value="checked=true"}
                        {else}
                            {assign var="checked" value=""}
                        {/if}
                        <input type="checkbox" name="fluxos[]" value="{$fluxo.idFluxo}" {$checked} class="no_border" title="{$fluxo.descricao}" id="fluxo_{$fluxo.idFluxo}" />
                        <label title="{$fluxo.descricao}" for="fluxo_{$fluxo.idFluxo}"> {$fluxo.nome} </label>
                    </li>
                    {/foreach}
                </ul>
                <div class="clear"> </div>
            </li>
            {/foreach}
        </ul>
        <div class="clear"> </div>
        <div class="sub_conteudo">
            <input type="button" class="btnC" title="Salvar alterações nos módulos" value="Salvar" onclick="GestaoUsuarios.updateFluxos()" />
            &nbsp;
            <input type="button" class="btnC btnC_alert" onclick="this.form.reset()" title="Cancelar alterações nos módulos" value="Cancelar" />
        </div>
    </form>
</div>