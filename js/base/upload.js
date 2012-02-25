var TelaPrincipal = Class.create();
TelaPrincipal.prototype = {
	initialize : function()
	{
	}
}

TelaPrincipal.lastUploads = new Array();

TelaPrincipal.uploadArquivo = function(idInput, idForm)
{
	var objFile = $(idInput);
	var objForm = $(idForm);
	var objParent = objFile.parentNode;

	if (objFile.value.length == 0)
	{
		return false;
	}

	var progressBar = document.createElement('img');
	progressBar.src = "../imagem/admin/progress_bar.gif";

	objInputs = objForm.getElementsByTagName("input");

	objForm.appendChild(objFile);
	objParent.appendChild(progressBar);

	if (objFile.value.length > 0)
	{
		objForm.submit();
	}

	this.lastUploads[idForm] = new Array();
	this.lastUploads[idForm]['parent'] = objParent;
	this.lastUploads[idForm]['input'] = objFile;
}

TelaPrincipal.cancelUpload = function(params)
{
	if (this.lastUploads[params.idFormUpload])
	{
		$(params.idFormUpload).reset();
		var objParent = this.lastUploads[params.idFormUpload]['parent'];
		var objInput = this.lastUploads[params.idFormUpload]['input'];

		this.removeTempFile($(params.inputDestArquivo).value, ConfigAdmin.URL_APP);
		$(params.inputDestArquivo).value = '';

		objParent.innerHTML = '';
		objParent.appendChild(objInput);
	}

	$(params.containerPreview).innerHTML = '';
	$(params.containerLegenda).innerHTML = '';
}

TelaPrincipal.removeTempFile = function(arquivo, url)
{
	if (arquivo.length > 0)
	{
		ajaxOptions = {
			parameters :"ACTION=RemoveTempFileAction&arquivo=" + arquivo
		}
		new Ajax.Request(url, ajaxOptions);
	}
}

TelaPrincipal.createImg = function(params)
{
	var objImg = document.createElement('img');
	objImg.src = params.src;
	objImg.id = params.id;

	return objImg;
}

TelaPrincipal.createFlash = function(params)
{
	var objEmbed = document.createElement("embed");
	objEmbed.src = params.src;
	objEmbed.id = params.id;

	objEmbed.setAttribute("loop", "true");
	objEmbed.setAttribute("autostart", "true");
	objEmbed.setAttribute("wmode", "transparent");

	return objEmbed;
}