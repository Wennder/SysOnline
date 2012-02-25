var ControleAcesso = Class.create({});

ControleAcesso.entrarSistema = function()
{
	$('formLogin').action = ConfigAdmin.URL_APP;
	$('formLogin').request();
}

ControleAcesso.initIndex = function()
{
	ajaxOptions = 
	{
		parameters:"ACTION=InitIndexAction"
	}
	
	new Ajax.Request(ConfigAdmin.URL_APP,  ajaxOptions);
}

ControleAcesso.sairSistema = function()
{
	ajaxOptions = 
	{
		parameters:"ACTION=FazerLogoffAction"	
	}
	
	new Ajax.Request(ConfigAdmin.URL_APP,  ajaxOptions);	
}