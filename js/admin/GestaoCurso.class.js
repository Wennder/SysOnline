var GestaoCurso = Class.create({});

GestaoCurso.initCad = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitCadCursoAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}


GestaoCurso.cadCurso = function()
{
    js.btnSubmit('formSaveCurso');

    $('formSaveCurso').action = ConfigAdmin.URL_APP;
    $('formSaveCurso').request();
}

GestaoCurso.initList = function()
{
    ajaxOptions =
    {
        parameters :"ACTION=InitListCursoAction"
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCurso.execList = function()
{
    $('formListCurso').action = ConfigAdmin.URL_APP;
    $('formListCurso').request();
}

GestaoCurso.initEdit = function(id)
{
    ajaxOptions =
    {
        parameters :"ACTION=InitEditCursoAction&idCurso=" + id
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCurso.mudaStatus = function(id, status)
{
    ajaxOptions =
    {
        parameters :"ACTION=MudaStatusCursoAction&idCurso=" + id + '&status=' + status
    }

    new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
}

GestaoCurso.execDel = function()
{
    if (confirm('Você está certo disso?'))
    {
        $('formDelCurso').action = ConfigAdmin.URL_APP;
        $('formDelCurso').request();
    }
}