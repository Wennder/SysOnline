function scriptJpanel()
{
    this.lastUploads = new Array();
	
    this.gE = function(id)
    {
        return document.getElementById(id);
    }

    this.gEs = function(tag)
    {
        return document.getElementsByTagName(tag);
    }

    this.showMenuLi = function(obj)
    {
        var item = obj.parentNode.getElementsByTagName("ul")[0];

        if (jQuery(item).css("display") == "none")
        {
            jQuery(item).slideDown("fast");
        } else
        {
            jQuery(item).slideUp("fast");
        }
    }

    this.hideMenu = function()
    {
        if (jQuery('#menu').css("display") == "block")
        {
            jQuery('#menu').css( {
                display :"none"
            });
            jQuery('#menu').css( {
                width :"0px"
            });
            jQuery('#left').css( {
                width :"0px"
            });
            jQuery('#meio').css( {
                width :"900px",
                marginLeft :"25px"
            });
            jQuery('#tree').css( {
                marginTop :"25px",
                marginLeft :"25px"
            });
            jQuery('.container_busca').css( {
                marginLeft :"215px"
            });
            jQuery('.aux_field').css( {
                marginLeft :"130px"
            });
            jQuery('.dest-home').css( {
                marginLeft :"18%"
            });
            jQuery('.icons').css( {
                width :"900px"
            });

        } else
{
            jQuery('#menu').css( {
                display :"block"
            });
            jQuery('#menu').css( {
                width :"180px"
            });
            jQuery('#left').css( {
                width :"180px"
            });
            jQuery('#meio').css( {
                width :"720px",
                marginLeft :"0px"
            });
            jQuery('#tree').css( {
                marginTop :"20px",
                marginLeft :"208px"
            });
            jQuery('.container_busca').css( {
                marginLeft :"145px"
            });
            jQuery('.aux_field').css( {
                marginLeft :"130px"
            });
            jQuery('.dest-home').css( {
                marginLeft :"9%"
            });
            jQuery('.icons').css( {
                width :"720px"
            });
        }
    }


    this.checkAll = function()
    {

        myInput = this.gEs('input');

        for (i = 0; i < myInput.length; i++)
        {
            if (myInput[i].type == "checkbox")
            {
                if (myInput[i].checked == false)
                {
                    myInput[i].checked = true;
                    myInput[i].parentNode.parentNode.className = "colorTr";

                } else
{
                    myInput[i].checked = false;
                    myInput[i].parentNode.parentNode.className = "";
                }
            }
        }
    }

    this.showSearchs = function()
    {
        var divSearch = this.gE('search');
        var divReports = this.gE('reports');
        if (jQuery(divSearch).css("display") == 'none')
        {
            jQuery(divSearch).slideDown("fast");
            jQuery(divReports).hide();

        } else
        {
            jQuery(divSearch).slideUp("fast");
        }
    }

    this.showReports = function()
    {
        var divReports = this.gE('reports');
        var divSearch = this.gE('search');
        if (jQuery(divReports).css("display") == 'none')
        {
            jQuery(divReports).slideDown("fast");
            jQuery(divSearch).hide();

        } else
        {
            jQuery(divReports).slideUp("fast");
        }
    }

    this.collorTrHover = function()
    {
        myInput = this.gEs('input');
        myTr = jQuery('.trTable');

        for (i = 0; i < myTr.length; i++)
        {
            myTr[i].onmouseover = this.mouseOverTr;
            myTr[i].onmouseout = this.mouseOutTr;
        }

        for (i = 0; i < myInput.length; i++)
        {
            if (myInput[i].type == "checkbox")
            {
                myInput[i].onclick = this.colorCheck;
            }
        }
    }

    this.colorCheck = function()
    {
        if (this.checked)
        {
            this.parentNode.parentNode.className = "colorTr";
        } else
{
            this.parentNode.parentNode.className = "";
        }
    }

    this.mouseOverTr = function()
    {
        if (this.className != "colorTr")
        {
            this.className = "colorTrHover";
        }
    }

    this.mouseOutTr = function()
    {
        if (this.className != "colorTr")
        {
            this.className = "";
        }
    }

    this.changeMenu = function(obj)
    {
        var myul = obj.parentNode.parentNode.parentNode.parentNode;
        var menu = myul.getElementsByTagName("a");
        for ( var i = 0; i < menu.length; i++)
        {
            menu[i].className = "";
        }
        obj.className = "selected";
    }

    this.loading = function()
    {
        $('gif_load').style.visibility = "visible";
    }

    this.loaded = function()
    {
        $('gif_load').style.visibility = "hidden";
    }

    /* Adicionar KeyWords */

    this.addPalavra = function(event, idForm)
    {
        var exists = false;
        var key = $(idForm + '_telefones').value;
        var ul = jQuery("#" + idForm + '_container_telefones > li > input');


        if (event && event.keyCode != 13)
        {
            return;
        }

        ul.each(function(){
            if(jQuery(this).val() == key){
                exists = true;
            }
        });
        
        if(key != "" && !exists){
            this.execAddPalavra(key, idForm);
        }
        
    }

    this.execAddPalavra = function(key, idForm)
    {
        var idLi = 'li_' + Math.random();
        var strIn = "<li class=\"add_words\" id=\"" + idLi + "\"><input type=\"text\" class=\"input_text\" name=\"telefones[]\" disabled=\"true\" value=\"" + key + "\" /><input type=\"hidden\" name=\"telefones[]\" value=\"" + key + "\" />&nbsp; <a href=\"javascript:;\" class=\"color_b\" onclick=\"js.delPalavra('" + idLi + "', '" + idForm + "')\" title=\"Remover Palavra\">&nbsp;&nbsp;[Remover telefone]</a></li>";

        $(idForm + '_container_telefones').innerHTML += strIn;
        $(idForm + '_telefones').value = '';
    }

    this.delPalavra = function(id, idForm)
    {
        $(idForm + '_container_telefones').removeChild($(id));
    }

    /* Adicionar Elementos de despesa */

    this.addElementosDespesa = function(event, idForm)
    {
        var exists1 = false;
        var exists2 = false;
        var elementosDespesasID = jQuery("#" + idForm + "_elementosDespesas").val();
        var elementosDespesasTXT = jQuery("#" + idForm + "_elementosDespesas option:selected").attr("label");
        var valores = $(idForm + '_valores').value;
        var ulED = jQuery("#" + idForm + '_container_elementosDespesas > li > input[name="elementosDespesas[]"]').not('[disabled=true]');
        var ulValor = jQuery("#" + idForm + '_container_elementosDespesas > li > input[name="valores[]"]').not('[type="hidden"]');


        if (event && event.keyCode != 13)
        {
            return;
        }

        ulED.each(function(){
            if(jQuery(this).val() == elementosDespesasTXT){
                exists1 = true;
            }
        });


        ulValor.each(function(){
            if(jQuery(this).val() == valores){
                exists2 = true;
            }
        });

        if((elementosDespesasID != 0 && !exists1) && (valores != "" && !exists2)){
            this.execElementosDespesa(elementosDespesasID, elementosDespesasTXT, valores, idForm);
        }

    }

    this.execElementosDespesa = function(elementosDespesasID, elementosDespesasTXT, valores, idForm)
    {
        var idLi = 'li_' + Math.random();
        var strIn = "<li class=\"add_words\" style=\"border-bottom:solid 1px #ccc;border-right:solid 1px #ccc;padding:5px 5px 5px 0;\" id=\"" + idLi + "\"><label style=\"float:left;width:130px;font-weight:bold;\">Elemento de despesa: </label>&nbsp;<input type=\"text\" class=\"input_text\" name=\"elementosDespesas[]\" disabled=\"true\" value=\"" + elementosDespesasTXT + "\" /><input type=\"hidden\" name=\"elementosDespesas[]\" value=\"" + elementosDespesasID + "\" /><br/><label style=\"float:left;width:130px;font-weight:bold;margin-top:12px;\">Valor: </label>&nbsp;<input type=\"text\" class=\"input_text\" name=\"valores[]\" disabled=\"true\" value=\"" + valores + "\" /><input type=\"hidden\" name=\"valores[]\" value=\"" + valores + "\" /> <a href=\"javascript:;\" class=\"color_b\" onclick=\"js.delElementosDespesa('" + idLi + "', '" + idForm + "')\" title=\"Remover Elemento de despesa\">&nbsp;&nbsp;[Remover]</a></li>";

        $(idForm + '_container_elementosDespesas').innerHTML += strIn;
        $(idForm + '_elementosDespesas').value = '';
        $(idForm + '_valores').value = '';
    }

    this.delElementosDespesa = function(id, idForm)
    {
        $(idForm + '_container_elementosDespesas').removeChild($(id));
    }

    /* Adicionar Elementos de despesaPC */

    this.addElementosDespesaPC = function(event, idForm)
    {
        var exists1 = false;
        var exists2 = false;
        var elementosDespesasID = jQuery("#" + idForm + "_elementosDespesasPC").val();
        var elementosDespesasTXT = jQuery("#" + idForm + "_elementosDespesasPC option:selected").attr("label");
        var valores = $(idForm + '_valoresPC').value;
        var ulED = jQuery("#" + idForm + '_container_elementosDespesasPC > li > input[name="elementosDespesasPC[]"]').not('[disabled=true]');
        var ulValor = jQuery('#' + idForm + '_container_elementosDespesasPC > li > input[name="valoresPC[]"]').not('[type="hidden"]');


        if (event && event.keyCode != 13)
        {
            return;
        }

        ulED.each(function(){
            if(jQuery(this).val() == elementosDespesasTXT){
                exists1 = true;
            }
        });


        ulValor.each(function(){
            if(jQuery(this).val() == valores){
                exists2 = true;
            }
        });

        if((elementosDespesasID != 0 && !exists1) && (valores != "" && !exists2)){
            this.execElementosDespesaPC(elementosDespesasID, elementosDespesasTXT, valores, idForm);
        }

    }

    this.execElementosDespesaPC = function(elementosDespesasID, elementosDespesasTXT, valores, idForm)
    {
        var idLi = 'li_' + Math.random();
        var strIn = "<li class=\"add_words\" style=\"border-bottom:solid 1px #ccc;border-right:solid 1px #ccc;padding:5px 5px 5px 0;\" id=\"" + idLi + "\"><label style=\"float:left;width:130px;font-weight:bold;\">Elemento de despesa: </label>&nbsp;<input type=\"text\" class=\"input_text\" name=\"elementosDespesas[]\" disabled=\"true\" value=\"" + elementosDespesasTXT + "\" /><input type=\"hidden\" name=\"elementosDespesas[]\" value=\"" + elementosDespesasID + "\" /><br/><label style=\"float:left;width:130px;font-weight:bold;margin-top:12px;\">Valor: </label>&nbsp;<input type=\"text\" class=\"input_text\" name=\"valores[]\" disabled=\"true\" value=\"" + valores + "\" /><input type=\"hidden\" name=\"valores[]\" value=\"" + valores + "\" /> <a href=\"javascript:;\" class=\"color_b\" onclick=\"js.delElementosDespesa('" + idLi + "', '" + idForm + "')\" title=\"Remover Elemento de despesa\">&nbsp;&nbsp;[Remover]</a></li>";

        $(idForm + '_container_elementosDespesasPC').innerHTML += strIn;
        $(idForm + '_elementosDespesasPC').value = '';
        $(idForm + '_valoresPC').value = '';
    }

    this.delElementosDespesaPC = function(id, idForm)
    {
        $(idForm + '_container_elementosDespesasPC').removeChild($(id));
    }

    /* Adicionar alternativas na enquete */

    this.addAlternativa = function(event, idForm)
    {
        if (event && event.keyCode != 13)
        {
            return;
        }

        this.execAddAlternativa($(idForm + '_alternativas').value, idForm);
    }

    var i = 1;
    this.execAddAlternativa = function(key, idForm)
    {
        var idLi = 'li_' + Math.random();
        var strIn = "";
        strIn += "<li class=\"add_words\" id=\"" + idLi + "\"><label for=\"" + i + "\">Alternativa " + i + ":</label><br/><input id=\"" + i + "\" type=\"text\" name=\"alternativas[]\" value=\"" + key + "\" /><input type=\"hidden\" name=\"alternativas[]\" value=\"" + key + "\" /></li>";
        $(idForm + '_container_alternativas').innerHTML += strIn;
        $(idForm + '_alternativas').value = '';
        i++;
    }

    this.delAlternativa = function(id, idForm)
    {
        $(idForm + '_container_alternativas').removeChild($(id));
    }

    this.changeTitle = function(myTitle)
    {
        document.title = myTitle;
    }

    this.pagSubmit = function(obj)
    {
        obj.form.action = ConfigAdmin.URL_APP;
        $(obj.form.id).request();// por causa do ie6
    }

    this.pagPrior = function(obj)
    {
        obj.form.pag.value--;
        this.pagSubmit(obj);
    }

    this.pagNext = function(obj)
    {
        obj.form.pag.value++;
        this.pagSubmit(obj);
    }

    this.getEditor = function(idTextarea)
    {
        var sBasePath = "../js/base/fckeditor/";
        var oFCKeditor = new FCKeditor(idTextarea);
        oFCKeditor.BasePath = sBasePath;
        oFCKeditor.ToolbarSet = "Basic";
        oFCKeditor.ReplaceTextarea();
    }

    this.getEditorContent = function(idTextarea)
    {
        var oEditor = FCKeditorAPI.GetInstance(idTextarea);
        return oEditor.GetXHTML();
    }

    this.imgChange = function(obj, funcao, id)
    {
        if (obj.getAttribute("src").indexOf("disable") > 0)
        {
            obj.setAttribute("src", "../imagem/admin/ok.png");
            obj.setAttribute("title", "Já publicada. Remover publicação.");
            obj.parentNode.href = 'javascript:' + funcao + "(" + id + "," + 0 + ")";

        } else
{
            obj.setAttribute("src", "../imagem/admin/disable.png");
            obj.setAttribute("title", "Não Publicada. Publicar.");
            obj.parentNode.href = 'javascript:' + funcao + "(" + id + "," + 1 + ")";
        }
    }

    this.changeColorLink = function(obj)
    {
        obj.style.backgroundColor = "#FFDFDF";
    }

    this.hideColorLink = function(obj)
    {
        obj.style.backgroundColor = "inherit";
    }

    this.promptMenssage = function(titulo, texto, erro)
    {
        if (erro == false)
        {
            jQuery.prompt('<h3 class="ok_msg">' + titulo + '<h3/>' + '<span class="mt-10">' + texto + '</span>', {
                show :'slideDown'
            }, false);
        } else
{
            jQuery.prompt('<h3 class="erro_msg">' + titulo + '<h3/>' + '<span class="mt-10">' + texto + '</span>', {
                show :'slideDown'
            }, true);
        }
    }
	
    this.btnReset = function(idForm)
    {
        jQuery('.' + idForm + '_submit').each( function(i)
        {
            this.onclick = this.onclickAntigo;
            this.title = this.titleAntigo;
        });
    }

    this.btnSubmit = function(idForm)
    {
        jQuery('.' + idForm + '_submit').each( function(i)
        {
            this.onclickAntigo = this.onclick;
            this.onclick = null;
            this.titleAntigo = this.title;
            this.title = 'Enviando';
        });
    }

    this.checkUncheckAll = function(el){

        var selected = el.id;
        var idCaso = jQuery("#" + selected).parent().parent().attr("id");
        var elClick = jQuery("#" + idCaso).find(".all_selected").find("input");
        var casos = jQuery("#" + idCaso + " > .format");
        casos.each(function(){
            if(elClick.attr("checked") != false){
                jQuery(this).find("input").attr("checked","checked");
            }else{
                jQuery(this).find("input").removeAttr("checked");
            }
        });
    }

    this.getterReports = function(sql){

        var tamanho = 900;
        var altura = 600;

        var w = screen.width;
        var h = screen.height;

        var meio_tamanho = tamanho/2;
        var meio_altura = altura/2;

        var meio_w = w/2;
        var meio_h = h/2;

        var diff_w = meio_w - meio_tamanho;
        var diff_h = meio_h - meio_altura;

        window.close();
        window.open('../../classes/modelo/admin/controle/admin/getterReports.php?sql=' + sql, 'Gerar Relatório', 'height='+altura+', width='+tamanho+', top='+diff_h+', left='+diff_w+', resizable=no');

    }

    this.upload = function(id)
    {
        $('formUploadArquivo').action = ConfigAdmin.URL_APP;

        this.uploadArquivo(id, 'formUploadArquivo');
    }

    this.confirmUpload = function (params)
    {
        $(params.idParentInput).innerHTML = "<font style=\"display: inline;\"> &nbsp;&nbsp;O upload do arquivo foi concluído com sucesso <img src=\"/imagem/admin/ok.png\"></font>";

        $(params.inputDestArquivo).value = params.nameFile;

        $('container_legenda_arquivo').innerHTML += "<strong style=\"display:block;color: #ff0000;margin-left:135px;\"><a href=\"javascript:;\" style=\"color:#ff0000;\" onClick=\"js.cancelUpload({idFormUpload:'" + params.idFormUpload + "', inputDestArquivo:'" + params.inputDestArquivo + "'});\"><span>[ Cancelar ]</span></a><strong>";
    }

    this.cancelUpload = function(params)
    {
        if (this.lastUploads[params.idFormUpload])
        {
            $(params.idFormUpload).reset();
            var objParent = this.lastUploads[params.idFormUpload]['parent'];
            var objInput = this.lastUploads[params.idFormUpload]['input'];

            this.removeTempFile($(params.inputDestArquivo).value);
            $(params.inputDestArquivo).value = '';

            objParent.innerHTML = '';
            objParent.appendChild(objInput);
        }
    }

    this.deleteUpload = function(params)
    {
        this.removeTempFile($(params.inputDestArquivo).value);
        $(params.inputDestArquivo).value = '';

    }

    this.removeTempFile = function(arquivo)
    {
        if (arquivo.length > 0)
        {
        alert(arquivo);
            ajaxOptions = {
                parameters :"ACTION=RemoveTempFileAction&arquivo=" + arquivo
            }
            new Ajax.Request(ConfigAdmin.URL_APP, ajaxOptions);
            $('container_legenda_arquivo').innerHTML  = "";
        }
    }

    this.uploadArquivo = function(idInput, idForm)
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

        for (i = 0; i < objInputs.length; i++)
        {
            if (objInputs[i].type == 'file')
            {
                objForm.removeChild(objInputs[i]);
            }
        }

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
    
    this.getCurrentMilisec = function(data){

        if(data != null || data != undefined){
            ano = data.substring(6,10);
            mes = data.substring(3,5);
            dia = data.substring(0,2);
            data = new Date(ano, mes, dia);
            return data.getTime();
        }else{
            return 0;
        }
    }

    this.validaIntervaloData = function(dataInicio, dataFim, idForm)
    {
        if(idForm != null || idForm != undefined){
            if((dataInicio != null || dataInicio != undefined) || (dataFim != null || dataFim != undefined)){
                jQuery(idForm).submit(function(){
                    dataInicioVal = jQuery(dataInicio).val();
                    dataFimVal = jQuery(dataFim).val();
                    if(dataInicioVal != "" && dataFimVal != ""){
                        if((js.getCurrentMilisec(dataFimVal)) < (js.getCurrentMilisec(dataInicioVal))){
                            jQuery(dataFim).addClass("erro_input");
                            jQuery(dataInicio).addClass("erro_input");
                            js.promptMenssage("Atenção", "A data de fim não pode ser menor que a data de início!", "true");
                        }
                    }
                });
            }
        }
    }
}

js = new scriptJpanel();