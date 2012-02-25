<div class="icons">
    <ul>
        <li><span id="save"><a href="javascript:;" id="formSaveFuncionario_submit" onclick="GestaoFuncionarios.cadFuncionario(); return false" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoFuncionarios.initList(); return false" title="Cancelar"><img src="{$smarty.const.HTTP_URL}imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>
<fieldset class="all">
    <legend>Cadastro de Funcionários</legend>
    <form action="" method="post" id="formSaveFuncionario" onsubmit="GestaoFuncionarios.cadFuncionario(); return false">
        <input type="hidden" name="ACTION" value="{$actionForm}" />
        <input type="hidden" name="formId" value="formSaveFuncionario" />
        <input type="hidden" name="idFuncionario" value="{$funcionario.idFuncionario}" />
        <div class="field">
            <label for="formSaveFuncionario_nome" class="lbl">Nome:</label>
            <input id="formSaveFuncionario_nome" name="nome" type="text" class="input_text" value="{$funcionario.nome}" title="Digite um Nome para o funcionário"/>
            <span class="aux_field" id="formSaveFuncionario_auxField_nome">Digite um Nome para o funcionário</span>
        </div>
        <div class="field">
            <label for="formSaveFuncionario_matricula" class="lbl">Matrícula:</label>
            <input id="formSaveFuncionario_matricula" name="matricula" type="text" class="input_text" value="{$funcionario.matricula}" title="Digite a Matrícula do funcionário"/>
            <span class="aux_field" id="formSaveFuncionario_auxField_matricula">Digite a Matrícula do funcionário</span>
        </div>
        <div class="field">
            <label for="formSaveFuncionario_cpf" class="lbl">Cpf:</label>
            <input id="formSaveFuncionario_cpf" name="cpf" type="text" class="input_text" value="{$funcionario.cpf}" title="Digite o Cpf do funcionário"/>
            <span class="aux_field" id="formSaveFuncionario_auxField_cpf">Digite o Cpf do funcionário</span>
        </div>
        <div class="field">
            <label for="formSaveFuncionario_rg" class="lbl">Rg:</label>
            <input id="formSaveFuncionario_rg" name="rg" type="text" class="input_text" value="{$funcionario.rg}" title="Digite o Rg do funcionário"/>
            <span class="aux_field" id="formSaveFuncionario_auxField_rg">Digite o Rg do funcionário</span>
        </div>
        <div class="field">
            <label for="formSaveFuncionario_pis" class="lbl">Pis:</label>
            <input id="formSaveFuncionario_pis" name="pis" type="text" class="input_text" value="{$funcionario.pis}" title="Digite o Pis do funcionário"/>
            <span class="aux_field" id="formSaveFuncionario_auxField_pis">Digite o Pis para do funcionário</span>
        </div>
        <div class="field">
            <label for="formSaveFuncionario_cargo" class="lbl">Cargos:</label>
            <select id="formSaveFuncionario_cargo" name="cargo" title="É a cargo do funcionario.">
                <option value="0"> Selecione </option>
				{html_options options=$optionsCargo selected=$funcionario.idCargo}
            </select><br class="none"/>
            <span class="aux_field" id="formSaveFuncionario_auxField_cargo">
			Selecione um cargo
            </span>
        </div>
        <div class="field">
            <label for="formSaveFuncionario_campus" class="lbl">Campus:</label>
            <select id="formSaveFuncionario_campus" name="campus" title="É a campus do funcionario.">
                <option value="0"> Selecione </option>
				{html_options options=$optionsCampus selected=$funcionario.idCampus}
            </select><br class="none"/>
            <span class="aux_field" id="formSaveFuncionario_auxField_campus">
			Selecione um campus
            </span>
        </div>
    </form>
    <script language="javascript" type="text/javascript">
            FormUtil.initForm('formSaveFuncionario');
    </script>
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
        <li><span id="save"><a href="javascript:;" onclick="GestaoFuncionarios.cadFuncionario(); return false" title="Salvar"><img src="{$smarty.const.HTTP_URL}imagem/admin/save.png" alt=""/>Salvar</a></span></li>
        <li><span id="cancel"><a href="javascript:;" onclick="GestaoFuncionarios.initList(); return false" title="Cancelar"><img src="{$smarty.const.HTTP_URL}imagem/admin/cancel.png" alt=""/>Cancelar</a></span></li>
    </ul>
</div>