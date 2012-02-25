<?php

require_once 'classes/modelo/admin/controle/usuarios/LoginUnicoValidator.class.php';
require_once 'classes/base/controle/validacao/InteiroPositivoValidator.class.php';
require_once 'classes/base/controle/validacao/NoValidator.class.php';
require_once 'classes/base/controle/validacao/ArrayValidator.class.php';
require_once 'classes/base/sistema/ListagemUtil.class.php';
require_once 'classes/base/controle/validacao/SenhaValidator.class.php';
require_once 'classes/base/controle/validacao/SenhasIguaisValidator.class.php';
require_once 'classes/base/controle/validacao/StringNotEmptyValidator.class.php';
require_once 'classes/base/controle/validacao/LoginValidator.class.php';
require_once 'classes/base/controle/validacao/ValidationFacade.class.php';

class GestaoUsuarios {
    const NUM_ITENS = 10;

    public function getCamposOrdemLista($formatMap = FALSE) {
        $map ['0'] ['label'] = "Nome";
        $map ['0'] ['campo'] = "stbusuarioinfo.nome";
        $map ['1'] ['label'] = "Data de Cadastro";
        $map ['1'] ['campo'] = "stbusuario.dataCadastro";
        $map ['2'] ['label'] = "Login";
        $map ['2'] ['campo'] = "stbusuario.login";
        $map ['3'] ['label'] = "Email";
        $map ['3'] ['campo'] = "stbusuario.email";

        $result = $map;

        if ($formatMap) {
            $result = ListagemUtil::formatMapLista($map);
        }

        return $result;
    }

    public static function validateRequestCad($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new LoginValidator("login", "O login deve conter apenas letras ou números."));
        $controlValidation->addValidator(new LoginUnicoValidator("login", "Já existe um usuário com este login. Escolha outro diferente."));
        $controlValidation->addValidator(new SenhaValidator("senha", "A senha informada não foi aceita. Use apenas números e letras na senha."));
        $controlValidation->addValidator(new SenhasIguaisValidator("senha", "confSenha", "As senhas informadas precisam ser iguais."));
        $controlValidation->addValidator(new StringNotEmptyValidator("email", "O e-mail não pode ser vazio."));
        $controlValidation->addValidator(new StringNotEmptyValidator("nome", "O nome não pode ser vazio."));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestAlt($rawRequest) {
        $controlValidation = new ValidationFacade();

        $senha = $rawRequest->getForValidation('senha');

        $controlValidation->addValidator(new InteiroPositivoValidator("idUsuario", "Falta informar o usuário que será alterado."));
        $controlValidation->addValidator(new LoginValidator("login", "O login deve conter apenas letras ou números."));

        if ($rawRequest->getForValidation('login') != $rawRequest->getForValidation('loginAntigo')) {
            $controlValidation->addValidator(new LoginUnicoValidator("login", "Já existe um usuário com este login. Escolha outro diferente."));
        }

        $controlValidation->addValidator(new StringNotEmptyValidator("email", "O e-mail não pode ser vazio."));
        $controlValidation->addValidator(new StringNotEmptyValidator("nome", "O nome não pode ser vazio."));

        if (!empty($senha)) {
            $controlValidation->addValidator(new SenhaValidator("senha", "A senha informada não foi aceita. Use apenas números e letras na senha."));
            $controlValidation->addValidator(new SenhasIguaisValidator("senha", "confSenha", "As senhas informadas precisam ser iguais."));
        }

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestList($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new StringNotEmptyValidator("ACTION", ""));
        $controlValidation->addValidator(new NoValidator("usuario", ""));
        $controlValidation->addValidator(new NoValidator("ordem", ""));
        $controlValidation->addValidator(new NoValidator("sentido", ""));
        $controlValidation->addValidator(new NoValidator("pag", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestID($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new InteiroPositivoValidator("idUsuario", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestDel($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new ArrayValidator("idUsuarios", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestMudaStatus($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new NoValidator("idUsuario", ""));
        $controlValidation->addValidator(new NoValidator("status", ""));

        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestInitAlt($rawRequest) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new InteiroPositivoValidator("idUsuario", ""));
        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function validateRequestPermissoes($rawRequest, $nomeArray) {
        $controlValidation = new ValidationFacade();

        $controlValidation->addValidator(new InteiroPositivoValidator("idUsuario", "Falta informar o usuário que vai ter as permissões atualizadas."));
        $controlValidation->addValidator(new NoValidator($nomeArray));
        $controlValidation->validate($rawRequest);

        return $controlValidation;
    }

    public static function mudaStatus($idUsuario, $status) {
        if ($status == 1) {
            $novoStatus = 0;
        } else {
            $novoStatus = 1;
        }

        $dao = new DAOUsuario();
        $result ['ok'] = $dao->mudaStatus($idUsuario, $novoStatus);
        $result ['status'] = $novoStatus;

        return $result;
    }

    public static function deleteUser($idUsuario) {
        $dao = new DAOUsuario();
        return $dao->deleteUser($idUsuario);
    }

    public static function filtroBasico($params) {
        $nome = (isset($params ['usuario'])) ? ($params ['usuario']) : ("");
        $ordem = ($params ['ordem'] == null) ? (0) : ($params ['ordem']);
        $sentido = (isset($params ['sentido'])) ? ($params ['sentido']) : (ListagemUtil::lISTA_DESC);
        $li = (isset($params ['li'])) ? ($params ['li']) : (0);
        $numItens = (isset($params ['numItens'])) ? ($params ['numItens']) : (self::NUM_ITENS);

        unset($params);

        $strWhere = "status <> '-1'";
        $strWhere .= ( !empty($nome)) ? (" and (stbusuarioinfo.nome like '%{$nome}%' or stbusuarioinfo.email like '%{$nome}%' or stbusuario.login like '%{$nome}%')") : ("");

        if ($li < 0) {
            $li = 0;
        }
        if ($numItens <= 0) {
            $numItens = 10;
        }

        $campoOrdem = ListagemUtil::getCampoOrdem($ordem, self::getCamposOrdemLista ());
        $sentidoOrdem = ($sentido == ListagemUtil::LISTA_ASC) ? ("asc") : ("desc");

        $filtro ['tabelas'] = "stbusuarioinfo";
        $filtro ['campos'] = "stbusuarioinfo.*, stbusuario.*";
        $filtro ['join'] = "inner join stbusuario on stbusuario.idUsuario = stbusuarioinfo.idUsuario";
        $filtro ['group'] = "";
        $filtro ['condicao'] = $strWhere;
        $filtro ['ordem'] = "order by {$campoOrdem} {$sentidoOrdem}";
        $filtro ['li'] = $li;
        $filtro ['numItens'] = $numItens;

        return $filtro;
    }

}

?>
