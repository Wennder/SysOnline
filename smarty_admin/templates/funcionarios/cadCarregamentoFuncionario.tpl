<div class="icons">
    <ul>
        <li><span id="save"><a href="javascript:;" class="btn" onclick="GestaoConversor.carregarFuncionarios('.btn');" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
    </ul>
</div>
<fieldset class="all">
    <legend>Carregar Funcionários</legend>
    <form action="{$smarty.const.HTTP_URL}conversor/loadArq.php" method="post" id="formCarregaFuncionarios" enctype="multipart/form-data">
        <div class="field" style="padding-bottom: 40px;">
            <label for="arq" class="lbl" style="width: 100%;text-align: left;">Selecione o arquivo .csv com os dados dos servidores:</label><br/><br/>
            <input type="file" name="arq" size="27"/>
            <span class="aux_field" style="margin-left: 0;">Selecione o arquivo de extensão .csv para poder inserir no sistema os funcionários.</span>
        </div>
    </form>
</fieldset>
<div class="icons">
    <span class="hide">
        <a onclick="js.hideMenu();" href="javascript:;" title="Esconder/Mostrar Menu">
            <span style="display:none">
                <<
            </span>
        </a>
    </span>
    <ul>
        <li><span id="save"><a href="javascript:;" class="btn" onclick="GestaoConversor.carregarFuncionarios('.btn');" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
    </ul>
</div>