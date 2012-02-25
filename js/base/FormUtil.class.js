var FormUtil = Class.create();
FormUtil.prototype =
{
	initialize : function()
	{
	}
}

FormUtil.PREFIX_AUX = "auxField";
FormUtil.CSS_FIELD_CLASS_ERROR = "field_alert";
FormUtil.CSS_AUX_CLASS_ERROR = "aux_field_alert";
FormUtil.CSS_MODE = "D";

FormUtil.hashForm = new Array();

FormUtil.showElementAuxField = function(objElement)
{
	if (this.CSS_MODE == 'D')
	{
		objElement.style.display = "block";
	}
	else
	{
		objElement.style.visibility = "visible";
	}
}

FormUtil.hideElementAuxField = function(objElement)
{
	if (this.CSS_MODE == 'D')
	{
		objElement.style.display = "none";
	}
	else
	{
		objElement.style.visibility = "hidden";
	}
}

FormUtil.resetErrors = function(idForm)
{
	if (this.hashForm[idForm])
	{
		for ( var i = 0; i < this.hashForm[idForm]['field'].length; i++)
		{
			try
			{
				this.resetError(idForm, this.hashForm[idForm]['field'][i].name);
			}
			catch (e)
			{
				//fazer nada
			}
		}
	}

	this.hashForm[idForm] = new Array();
	this.hashForm[idForm]['field'] = new Array();
	this.hashForm[idForm]['aux'] = new Array();
}

FormUtil.addHistoryField = function(idForm, elemento)
{
	var pos = this.hashForm[idForm]['field'].length;
	this.hashForm[idForm]['field'][pos] = elemento;
	elemento.posHash = pos;
}

FormUtil.addHistoryAuxField = function(idForm, elemento)
{
	var pos = this.hashForm[idForm]['aux'].length;
	this.hashForm[idForm]['aux'][pos] = elemento;
	elemento.posHash = pos;
}

FormUtil.setFocus = function(idForm, nomeField)
{
	var idField = idForm + "_" + nomeField;
	$(idField).focus();
}

FormUtil.resetError = function(idForm, nomeField)
{
	var idField = idForm + "_" + nomeField;
	var i = $(idField).posHash;

	this.hashForm[idForm]['field'][i].className = this.hashForm[idForm]['field'][i].classOK;
	this.hashForm[idForm]['aux'][i].className = this.hashForm[idForm]['aux'][i].classOK;
	this.hashForm[idForm]['aux'][i].innerHTML = this.hashForm[idForm]['field'][i].title;
	this.hideElementAuxField(this.hashForm[idForm]['aux'][i]);
}

FormUtil.setError = function(idForm, nomeField, mensagem)
{
	var idField = idForm + "_" + nomeField;
	var idAuxField = idForm + "_" + this.PREFIX_AUX + "_" + nomeField;

	try
	{
		$(idField).className = $(idField).classERRO;
		$(idAuxField).className = $(idAuxField).classERRO;
		$(idAuxField).innerHTML = mensagem;

		this.showElementAuxField($(idAuxField));
		this.addHistoryField(idForm, $(idField));
		this.addHistoryAuxField(idForm, $(idAuxField));
	}
	catch (e)
	{
		alert(mensagem);
	}
}

FormUtil.initForm = function(idForm)
{
	var title = "";
	var idAuxField = "";
	for (i = 0; i < $(idForm).elements.length; i++)
	{
		idAuxField = idForm + "_" + this.PREFIX_AUX + "_" + $(idForm).elements[i].name;
		title = $(idForm).elements[i].title;
		if ($(idAuxField))
		{
			this.hideElementAuxField($(idAuxField));
			
			$(idForm).elements[i].FormUtil = this;
			$(idForm).elements[i].onfocus = this.showAuxField;
			$(idForm).elements[i].onblur = this.hideAuxField;
			$(idForm).elements[i].classOK = $(idForm).elements[i].className;
			$(idForm).elements[i].classERRO = $(idForm).elements[i].className + " " + this.CSS_FIELD_CLASS_ERROR;
			$(idAuxField).innerHTML = title;
			$(idAuxField).classOK = $(idAuxField).className;
			$(idAuxField).classERRO = $(idAuxField).className + " " + this.CSS_AUX_CLASS_ERROR;
		}
	}

	this.resetErrors(idForm);
}

FormUtil.showAuxField = function()
{
	var idForm = this.form.id;
	var idAuxField = idForm + "_" + this.FormUtil.PREFIX_AUX + "_" + this.name;
	this.FormUtil.showElementAuxField($(idAuxField));
}

FormUtil.hideAuxField = function()
{
	var idForm = this.form.id;
	var idAuxField = idForm + "_" + this.FormUtil.PREFIX_AUX + "_" + this.name;
	var isError = ($(idAuxField).className.indexOf(this.FormUtil.CSS_AUX_CLASS_ERROR) > 0);
	if (!isError)
	{
		this.FormUtil.hideElementAuxField($(idAuxField));
	}
}