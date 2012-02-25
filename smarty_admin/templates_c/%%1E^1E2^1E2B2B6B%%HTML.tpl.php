<?php /* Smarty version 2.6.12, created on 2011-11-24 23:34:10
         compiled from HTML.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
    <head>
        <title><?php echo $this->_tpl_vars['titulo']; ?>
 - SysAudi</title>
        <meta name="language" content="pt-br" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="author" content="Alan Carlos(alancarlosml@gmail.com) / Jeziel Marinho(jezielcm@gmail.com) / Igor Geysson" />
        <meta name="title" content="SysAudi - Sistema de Apoio à Auditoria Interna da Uespi"/>
        <meta name="description" content="Sistema de Apoio à Auditoria Interna da Uespi" />
        <link rel="stylesheet" type="text/css" href="<?php echo @HTTP_URL; ?>
css/admin/generic.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo @HTTP_URL; ?>
css/admin/estilo.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo @HTTP_URL; ?>
css/admin/index.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo @HTTP_URL; ?>
css/admin/inserir.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo @HTTP_URL; ?>
css/admin/listar.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo @HTTP_URL; ?>
css/admin/jquery.autocomplete.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo @HTTP_URL; ?>
css/admin/jquery-ui-1.8.4.custom.css"  media="screen"/>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/jquery.js"></script>
        <script language="javascript" type="text/javascript">jQuery.noConflict();</script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/jquery-impromptu.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/jquery.autocomplete.pack.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/jquery.ui.core.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/jquery.ui.widget.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/jquery.ui.datepicker.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/prototype.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/script.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/AjaxResponders.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/FormUtil.class.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/base/upload.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/BaseAdmin.class.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/ConfigAdmin.class.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/ControleAcesso.class.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/GestaoUsuarios.class.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/GestaoFuncionarios.class.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/GestaoCampi.class.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/GestaoCargos.class.js"></script>
	    <script language="javascript" type="text/javascript" src="<?php echo @HTTP_URL; ?>
js/admin/GestaoCurso.class.js"></script>
     
        <script language="javascript" type="text/javascript">
        FormUtil.PREFIX_AUX				= "auxField";
        FormUtil.CSS_FIELD_CLASS_ERROR	= "erro_input";
        FormUtil.CSS_AUX_CLASS_ERROR	= "erro_span";
        FormUtil.CSS_MODE				= "V";
        ControleAcesso.initIndex();
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="gif_load" style="visibility:hidden">
                <img src="<?php echo @HTTP_URL; ?>
imagem/admin/ajax-loader.gif" title="Carregando..." />
            </div>
            <div id="topo">
                <div id="logo">
                    <h1> <a href="javascript:;" onclick="ControleAcesso.initIndex()" title=" SysAudi - Sistema de Apoio à Auditoria Interna da Uespi">
                            <span class="none">
                                SysAudi - Sistema de Apoio à Auditoria Interna da Uespi
                            </span>
                        </a> </h1>
                </div>
                <div id="user">
                    <strong class="saudacao_data" id="saudacaoTemporal">
                    </strong>
                    <strong class="saudacao_user">Seja bem-vindo,
                        <a href="javascript:;" title="">
                            <span id="user_on">
                            </span>
                        </a>
                    </strong>
                    <span class="logout">
                        <a href="javascript:ControleAcesso.sairSistema();" title="Sair do sistema">Sair</a>
                    </span>
                </div>
            </div>
            <div id="content">
                <div id="topo_interno">
                    <div id="menu_horiz" class="mt-15">
                        <h3>SysOnline treinamento</h3>
                    </div>
                    <div id="tree">
                        <strong id="tituloTela">Página Inicial</strong>
                    </div>
                </div>
                <div id="left">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <div id="meio">
                    <div id="tela">
                    </div>
                </div>
            </div>
            <div class="clear">
            </div>
        </div>
    </body>
</html>