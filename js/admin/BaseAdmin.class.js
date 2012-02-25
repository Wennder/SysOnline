var BaseAdmin = Class.create( {});

BaseAdmin.limpaDropDown = function(idSelect)
{
	var qtd_dados = $(idSelect).length;

	for (i = 0; i < qtd_dados; i++)
	{
		$(idSelect).remove(i);
		qtd_dados--;
		i = 0;
	}

	$(idSelect).options[0] = new Option(":: Selecione ::", "");
}
BaseAdmin.addOptions = function(arrayOptions, formId)
{
	selectTarget = document.getElementById(formId);

	for (i = 1; i <= arrayOptions.length; i++)
	{
		selectTarget.options[i] = new Option(arrayOptions[i - 1]['txt'], arrayOptions[i - 1]['valor']);
	}
}
BaseAdmin.execOptions = function(idSelect, arrayOptions)
{
	this.limpaDropDown(idSelect);
	this.addOptions(arrayOptions, idSelect);
}
BaseAdmin.scrollTopo = function()
{
	$('body_pagina').scrollTop = 0;
}
BaseAdmin.getWTopDistance = function()
{
	var top = document.documentElement.scrollTop || document.body.scrollTop || 0;
	return top
}
BaseAdmin.setWTopPopUp = function(idDiv)
{
	var screenHeight = window.screen.availHeight;
	$(idDiv).style.top = this.getWTopDistance() + (screenHeight / 10) + 'px';
}
BaseAdmin.getHeightViewPort = function()
{
	var viewportheight = null;

	if (typeof window.innerWidth != 'undefined')
	{
		viewportheight = window.innerHeight
	}

	// IE6 in standards compliant mode (i.e. with a valid doctype as the first
	// line in the document)

	else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0)
	{
		viewportheight = document.documentElement.clientHeight
	}

	// older versions of IE

	else
	{
		viewportheight = document.getElementsByTagName('body')[0].clientHeight
	}
	
	return viewportheight;
}
BaseAdmin.lockScreen = function()
{
	var height = (this.getWTopDistance() == 0) ? this.getHeightViewPort() : document.body.offsetHeight;

	$('container_modal').style.width = document.body.offsetWidth + "px";
	$('container_modal').style.height = height + "px";
	$('container_modal').style.display = "block";

	$('container_modal_content').style.width = document.body.offsetWidth + "px";
	$('container_modal_content').style.height = height + "px";
	$('container_modal_content').style.display = "block";
}
BaseAdmin.freeScreen = function()
{
	$('container_modal').style.display = "none";
	$('container_modal_content').style.display = "none";
	$('container_modal_content').innerHTML = "";
}
BaseAdmin.setPop = function(html)
{
	this.lockScreen();
	$('container_modal_content').innerHTML = html;
}
BaseAdmin.clearPop = function()
{
	this.freeScreen();
	$('container_modal_content').innerHTML = '';
}
