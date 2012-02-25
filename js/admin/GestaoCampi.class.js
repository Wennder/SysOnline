var GestaoCampi = Class.create({});

GestaoCampi.initCad = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitCadCampusAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}


GestaoCampi.cadCampus = function()
{
    js.btnSubmit('formSaveCampus');

    $('formSaveCampus').action = ConfigAdmin.URL_APP;
    $('formSaveCampus').request();
}

GestaoCampi.initList = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitListCampusAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCampi.execList = function()
{
    $('formListCampus').action = ConfigAdmin.URL_APP;
    $('formListCampus').request();
}

GestaoCampi.initEdit = function(id)
{
    ajaxOptions =
    {
        parameters :"ACTION=InitEditCampusAction&idCampus=" + id
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCampi.execDel = function()
{
    if (confirm('Você está certo disso?'))
    {
        $('formDelCampi').action = ConfigAdmin.URL_APP;
        $('formDelCampi').request();
    }
}