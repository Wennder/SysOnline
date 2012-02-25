var GestaoCargos = Class.create({});

GestaoCargos.initCad = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitCadCargoAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}


GestaoCargos.cadCargo = function()
{
    js.btnSubmit('formSaveCargo');

    $('formSaveCargo').action = ConfigAdmin.URL_APP;
    $('formSaveCargo').request();
}

GestaoCargos.initList = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitListCargoAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCargos.execList = function()
{
    $('formListCargo').action = ConfigAdmin.URL_APP;
    $('formListCargo').request();
}

GestaoCargos.initEdit = function(id)
{
    ajaxOptions =
    {
        parameters :"ACTION=InitEditCargoAction&idCargo=" + id
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCargos.mudaStatus = function(id, status)
{
    ajaxOptions =
    {
        parameters :"ACTION=MudaStatusCargoAction&idCargo=" + id + '&status=' + status
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCargos.execDel = function()
{
    if (confirm('Você está certo disso?'))
    {
        $('formDelCargos').action = ConfigAdmin.URL_APP;
        $('formDelCargos').request();
    }
}