var GestaoUsuarios = Class.create({});

GestaoUsuarios.initCad = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitCadUsuarioAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}


GestaoUsuarios.cadUsuario = function()
{
    js.btnSubmit('formSaveUsuario');

    $('formSaveUsuario').action = ConfigAdmin.URL_APP;
    $('formSaveUsuario').request();
}

GestaoUsuarios.initList = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitListUsuarioAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoUsuarios.execList = function()
{
    $('formListUsuario').action = ConfigAdmin.URL_APP;
    $('formListUsuario').request();
}

GestaoUsuarios.initEdit = function(id)
{
    ajaxOptions =
    {
        parameters :"ACTION=InitEditUsuarioAction&idUsuario=" + id
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoUsuarios.mudaStatus = function(id, status)
{
    ajaxOptions =
    {
        parameters :"ACTION=MudaStatusUsuarioAction&idUsuario=" + id + '&status=' + status
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoUsuarios.execDel = function()
{
    if (confirm('Você está certo disso?'))
    {
        $('formDelUsuarios').action = ConfigAdmin.URL_APP;
        $('formDelUsuarios').request();
    }
}

GestaoUsuarios.gerenciaPermissoes = function(id)
{
    ajaxOptions = {
        parameters :"ACTION=GerenciarPermissoesUsuarioAction&idUsuario=" + id
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoUsuarios.updateGrupos = function()
{
    $('formPermissaoGrupos').action = ConfigAdmin.URL_APP;
    $('formPermissaoGrupos').request();
}

GestaoUsuarios.updateFluxos = function()
{
    $('formPermissaoModulos').action = ConfigAdmin.URL_APP;
    $('formPermissaoModulos').request();
}
