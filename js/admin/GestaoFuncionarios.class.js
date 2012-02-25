var GestaoFuncionarios = Class.create(
    {});

GestaoFuncionarios.initCad = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitCadFuncionarioAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}


GestaoFuncionarios.cadFuncionario = function()
{
    js.btnSubmit('formSaveFuncionario');

    $('formSaveFuncionario').action = ConfigAdmin.URL_APP;
    $('formSaveFuncionario').request();
}

GestaoFuncionarios.initList = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitListFuncionarioAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoFuncionarios.execList = function()
{
    $('formListFuncionario').action = ConfigAdmin.URL_APP;
    $('formListFuncionario').request();
}

GestaoFuncionarios.initEdit = function(id)
{
    ajaxOptions =
    {
        parameters :"ACTION=InitEditFuncionarioAction&idFuncionario=" + id
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoFuncionarios.execDel = function()
{
    if (confirm('Você está certo disso?'))
    {
        $('formDelFuncionarios').action = ConfigAdmin.URL_APP;
        $('formDelFuncionarios').request();
    }
}

GestaoFuncionarios.mudaStatus = function(id, status)
{
    ajaxOptions = {
        parameters :"ACTION=MudaStatusFuncionarioAction&idFuncionario=" + id + '&status=' + status
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}


GestaoFuncionarios.initAutoCompleteFuncionario = function(id, idField)
{
    jQuery(idField).autocomplete(ConfigAdmin.URL_APP + '?ACTION=AutoCompleteFuncionariosAction', {
        width: 440,
        scrollHeight: 220,
        selectFirst: true
    });

    jQuery(idField).result(function(event,data,formatted){
        jQuery(id).val(data[1]);
    });
};