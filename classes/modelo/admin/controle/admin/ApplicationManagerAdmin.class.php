<?php

require_once 'classes/base/controle/ApplicationManagerAbstract.class.php';
require_once ("classes/base/controle/MapAction.class.php");
require_once ("classes/base/controle/filtros/SQLInjectionFilter.class.php");
require_once ("classes/base/controle/filtros/SessionFilter.class.php");
require_once ("classes/base/controle/filtros/PermissionActionFilter.class.php");
require_once ("classes/base/controle/filtros/UTF8Filter.class.php");
require_once ("classes/base/controle/filtros/HTMLFilter.class.php");

class ApplicationManagerAdmin extends ApplicationManagerAbstract {

    public function initRequestFilters() {
        self::addFilter("SQLInjectionFilter", "SQLInjectionFilterException", "MensagemAction");
        self::addFilter("SessionFilter", "SessionFilterException", "MensagemAction");
        self::addFilter("PermissionActionFilter", "PermissionActionFilterException", "MensagemAction");
        self::addFilter("UTF8Filter", "", "");
        self::addFilter("HTMLFilter", "", "");
    }

    public function initMapActions() {
        MapAction::addAction("UploadArquivoAction", "classes/modelo/admin/controle/admin/UploadArquivoAction.class.php");
        MapAction::addAction("RemoveTempFileAction", "classes/modelo/admin/controle/admin/RemoveTempFileAction.class.php");

        //Controle de Acesso
        MapAction::addAction("MensagemAction", "classes/base/controle/MensagemAction.class.php");
        MapAction::addAction("FazerLoginAction", "classes/modelo/admin/controle/controle_acesso/FazerLoginAction.class.php");
        MapAction::addAction("FazerLogoffAction", "classes/modelo/admin/controle/controle_acesso/FazerLogoffAction.class.php");
        MapAction::addAction("InitIndexAction", "classes/modelo/admin/controle/controle_acesso/InitIndexAction.class.php");
        MapAction::addAction("LoadCidadesAction", "classes/modelo/admin/controle/admin/LoadCidadesAction.class.php");
        MapAction::addAction("LoadSetoresAction", "classes/modelo/admin/controle/admin/LoadSetoresAction.class.php");

        //Gestao de Usuarios
        MapAction::addAction("InitCadUsuarioAction", "classes/modelo/admin/controle/usuarios/InitCadUsuarioAction.class.php");
        MapAction::addAction("ExecCadUsuarioAction", "classes/modelo/admin/controle/usuarios/ExecCadUsuarioAction.class.php");
        MapAction::addAction("InitListUsuarioAction", "classes/modelo/admin/controle/usuarios/InitListUsuarioAction.class.php");
        MapAction::addAction("ExecListUsuariosAction", "classes/modelo/admin/controle/usuarios/ExecListUsuariosAction.class.php");
        MapAction::addAction("InitEditUsuarioAction", "classes/modelo/admin/controle/usuarios/InitEditUsuarioAction.class.php");
        MapAction::addAction("ExecEditUsuarioAction", "classes/modelo/admin/controle/usuarios/ExecEditUsuarioAction.class.php");
        MapAction::addAction("MudaStatusUsuarioAction", "classes/modelo/admin/controle/usuarios/MudaStatusUsuarioAction.class.php");
        MapAction::addAction("ExecDelUsuariosAction", "classes/modelo/admin/controle/usuarios/ExecDelUsuariosAction.class.php");
        MapAction::addAction("GerenciarPermissoesUsuarioAction", "classes/modelo/admin/controle/usuarios/GerenciarPermissoesUsuarioAction.class.php");
        MapAction::addAction("UpdateFluxosAction", "classes/modelo/admin/controle/usuarios/UpdateFluxosAction.class.php");
        MapAction::addAction("UpdateGruposAction", "classes/modelo/admin/controle/usuarios/UpdateGruposAction.class.php");
        MapAction::addAction("InitEditUsuarioAtualAction", "classes/modelo/admin/controle/usuarios/InitEditUsuarioAtualAction.class.php");
        MapAction::addAction("ExecEditUsuarioAtualAction", "classes/modelo/admin/controle/usuarios/ExecEditUsuarioAtualAction.class.php");

        //Gestao de Campus
        MapAction::addAction("InitCadCampusAction", "classes/modelo/admin/controle/campi/InitCadCampusAction.class.php");
        MapAction::addAction("ExecCadCampusAction", "classes/modelo/admin/controle/campi/ExecCadCampusAction.class.php");
        MapAction::addAction("InitListCampusAction", "classes/modelo/admin/controle/campi/InitListCampusAction.class.php");
        MapAction::addAction("ExecListCampiAction", "classes/modelo/admin/controle/campi/ExecListCampiAction.class.php");
        MapAction::addAction("InitEditCampusAction", "classes/modelo/admin/controle/campi/InitEditCampusAction.class.php");
        MapAction::addAction("ExecEditCampusAction", "classes/modelo/admin/controle/campi/ExecEditCampusAction.class.php");
        MapAction::addAction("MudaStatusCampusAction", "classes/modelo/admin/controle/campi/MudaStatusCampusAction.class.php");
        MapAction::addAction("ExecDelCampiAction", "classes/modelo/admin/controle/campi/ExecDelCampiAction.class.php");

        //Gestao de Cargos
        MapAction::addAction("InitCadCargoAction", "classes/modelo/admin/controle/cargos/InitCadCargoAction.class.php");
        MapAction::addAction("ExecCadCargoAction", "classes/modelo/admin/controle/cargos/ExecCadCargoAction.class.php");
        MapAction::addAction("InitListCargoAction", "classes/modelo/admin/controle/cargos/InitListCargoAction.class.php");
        MapAction::addAction("ExecListCargosAction", "classes/modelo/admin/controle/cargos/ExecListCargosAction.class.php");
        MapAction::addAction("InitEditCargoAction", "classes/modelo/admin/controle/cargos/InitEditCargoAction.class.php");
        MapAction::addAction("ExecEditCargoAction", "classes/modelo/admin/controle/cargos/ExecEditCargoAction.class.php");
        MapAction::addAction("MudaStatusCargoAction", "classes/modelo/admin/controle/cargos/MudaStatusCargoAction.class.php");
        MapAction::addAction("ExecDelCargosAction", "classes/modelo/admin/controle/cargos/ExecDelCargosAction.class.php");

       //Gestao de Curso
        MapAction::addAction("InitCadCursoAction", "classes/modelo/admin/controle/curso/InitCadCursoAction.class.php");
        MapAction::addAction("ExecCadCursoAction", "classes/modelo/admin/controle/curso/ExecCadCursoAction.class.php");
        MapAction::addAction("InitListCursoAction", "classes/modelo/admin/controle/curso/InitListCursoAction.class.php");
        MapAction::addAction("ExecListCursoAction", "classes/modelo/admin/controle/curso/ExecListCursoAction.class.php");
        MapAction::addAction("InitEditCursoAction", "classes/modelo/admin/controle/curso/InitEditCursoAction.class.php");
        MapAction::addAction("ExecEditCursoAction", "classes/modelo/admin/controle/curso/ExecEditCursoAction.class.php");
        MapAction::addAction("MudaStatusCursoAction", "classes/modelo/admin/controle/curso/MudaStatusCursoAction.class.php");
        MapAction::addAction("ExecDelCursoAction", "classes/modelo/admin/controle/curso/ExecDelCursoAction.class.php");
		
		
		
        //Gestao de Funcionarios
        MapAction::addAction("InitCadFuncionarioAction", "classes/modelo/admin/controle/funcionarios/InitCadFuncionarioAction.class.php");
        MapAction::addAction("ExecCadFuncionarioAction", "classes/modelo/admin/controle/funcionarios/ExecCadFuncionarioAction.class.php");
        MapAction::addAction("InitListFuncionarioAction", "classes/modelo/admin/controle/funcionarios/InitListFuncionarioAction.class.php");
        MapAction::addAction("ExecListFuncionariosAction", "classes/modelo/admin/controle/funcionarios/ExecListFuncionariosAction.class.php");
        MapAction::addAction("InitEditFuncionarioAction", "classes/modelo/admin/controle/funcionarios/InitEditFuncionarioAction.class.php");
        MapAction::addAction("ExecEditFuncionarioAction", "classes/modelo/admin/controle/funcionarios/ExecEditFuncionarioAction.class.php");
        MapAction::addAction("MudaStatusFuncionarioAction", "classes/modelo/admin/controle/funcionarios/MudaStatusFuncionarioAction.class.php");
        MapAction::addAction("ExecDelFuncionariosAction", "classes/modelo/admin/controle/funcionarios/ExecDelFuncionariosAction.class.php");
        MapAction::addAction("AutoCompleteFuncionariosAction", "classes/modelo/admin/controle/funcionarios/AutoCompleteFuncionariosAction.class.php");
        MapAction::addAction("InitCadCarregamentoAction", "classes/modelo/admin/controle/funcionarios/InitCadCarregamentoAction.class.php");

      
    }

}

?>