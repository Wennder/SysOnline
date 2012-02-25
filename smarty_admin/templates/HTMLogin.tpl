<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
<title>{$titulo}</title>
<meta name="language" content="pt-br" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Alan Carlos(alancarlosml@gmail.com) / Jeziel Marinho(jezielcm@gmail.com) / Igor Geysson" />
<meta name="title" content="SysAudi - Sistema de Apoio à Auditoria Interna da Uespi"/>
<meta name="description" content="Sistema de Apoio à Auditoria Interna da Uespi" />
<link rel="stylesheet" type="text/css" href="{$smarty.const.HTTP_URL}css/admin/generic.css"  media="screen"/>
<link rel="stylesheet" type="text/css" href="{$smarty.const.HTTP_URL}css/admin/estilo.css"  media="screen"/>
<link rel="stylesheet" type="text/css" href="{$smarty.const.HTTP_URL}css/admin/index.css"  media="screen"/>
<link rel="stylesheet" type="text/css" href="{$smarty.const.HTTP_URL}css/admin/login.css"  media="screen"/>

<script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/base/jquery.js"></script>
<script language="javascript" type="text/javascript">jQuery.noConflict();</script>
<script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/base/jquery-impromptu.js"></script>
<script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/base/prototype.js"></script>
<script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/admin/script.js"></script>
<script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/admin/ConfigAdmin.class.js"></script>
<script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/admin/ControleAcesso.class.js"></script>
<script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/base/FormUtil.class.js"></script><script language="javascript" type="text/javascript" src="{$smarty.const.HTTP_URL}js/admin/script.js"></script>
<script language="javascript" type="text/javascript">
FormUtil.PREFIX_AUX				= "auxField";
FormUtil.CSS_FIELD_CLASS_ERROR	= "erro_input";
FormUtil.CSS_AUX_CLASS_ERROR	= "erro_span";
FormUtil.CSS_MODE				= "V";
</script>

</head>
<body>
<div id="wrapper">
	<div id="meio">
	{$conteudo}
	</div>
</div>
</body>
</html>
