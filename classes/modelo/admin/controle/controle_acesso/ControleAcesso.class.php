<?php

require_once 'classes/modelo/admin/entidade/controle_acesso/DAOSessao.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/UsuarioInfo.class.php';
require_once 'classes/modelo/admin/entidade/controle_acesso/Fluxo.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/Usuario.class.php';
require_once 'classes/modelo/admin/entidade/controle_acesso/Sessao.class.php';
require_once 'classes/modelo/admin/entidade/controle_acesso/DAOCasoDeUso.class.php';
require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/base/sistema/Cookie.class.php';

/**
 * Classe responsável por controlar a entrada, saida e permissão de acesso aos fluxos do sistema.
 *
 */
class ControleAcesso {
    const ACTION_LOGIN = "FazerLoginAction";
    const ACTION_LOGOFF = "FazerLogoffAction";
    const LOGIN_ERRO = 0;
    const LOGIN_OK = 1;
    const ENTRADA_OK = 2;
    const SEM_FLUXOS = 3;
    const SESSAO_OK = 1;
    const SESSAO_EXPIRADA = 2;
    const SESSAO_EXCLUIDA = 3;
    const KEY_CASOS_DE_USO = "CASOS_DE_USO";
    const KEY_FLUXOS = "FLUXOS";
    const KEY_USUARIO = "USUARIO";

    public function __construct() {

    }

    private function execLogin($login, $senha) {
        $usuario = new Usuario ( );
        $erro ['usuario'] = null;
        $erro ['cod'] = self::LOGIN_ERRO;

        if (!Seguranca::loginIsValido($login)) {
            $result = &$erro;
        } elseif (!Seguranca::senhaIsValida($senha)) {
            $result = &$erro;
        } else {
            if ($usuario->execLogin($login, $senha)) {
                $result ['usuario'] = $usuario->getIdUsuario();
                $result ['cod'] = self::LOGIN_OK;
            } else {
                $result = &$erro;
            }
        }

        return $result;
    }

    public function execLoginCookie($login, $senha) {
        $dbConn = DatabaseConnectionFactory::getDefaultConnection();

        $sql = "select idUsuario from stbusuario where login = '{$login}' and senha = '{$senha}' and status <> '-1'";
        $dbResult = $dbConn->query($sql);
        if ($dbResult->rowCount() > 0) {
            $aux = $dbResult->getOneResult();
            $result ['usuario'] = $aux["idUsuario"];
            $result ['cod'] = self::LOGIN_OK;

            return $result;
        } else {
            return false;
        }
    }

    private function serializeFluxos($fluxos) {
        $dados = array();
        foreach ($fluxos as $fluxo) {
            $dados [$fluxo ['idFluxo']] ['nome'] = $fluxo ['nome'];
            $dados [$fluxo ['idFluxo']] ['priv'] = $fluxo ['priv'];
        }

        $_SESSION [self::KEY_FLUXOS] = serialize($dados);
    }

    public function unserializeFluxos() {
        $fluxos = unserialize($_SESSION [self::KEY_FLUXOS]);
        return $fluxos;
    }

    private function loadFluxos($idUsuario) {
        $ok = false;

        $fluxos = Fluxo::loadFluxos($idUsuario);

        foreach ($fluxos as $fluxo) {
            if (!empty($fluxo ['priv'])) {
                $ok = true;
                break;
            }
        }

        if ($ok) {
            ControleAcesso::serializeFluxos($fluxos);
            return true;
        } else {
            return false;
        }
    }

    private function serializeInfoUsuario($idUsuario) {
        $dao = new DAOObjectDB ( );

        $userInfo = new UsuarioInfo ( );
        $userInfo->setIdUsuario($idUsuario);

        $dao->load($userInfo);

        $_SESSION [self::KEY_USUARIO] = serialize($dao->toArray($userInfo));
    }

    public function unserializeInfoUsuario() {

        $usuarioArray = isset($_SESSION [self::KEY_USUARIO]) ? unserialize($_SESSION [self::KEY_USUARIO]) : null;
        return $usuarioArray;
    }

    public function getIdUsuarioOnline() {
        self::testSessao ();
        $usuario = self::unserializeInfoUsuario ();
        return $usuario ['idUsuario'];
    }

    private function serializeCasosDeUso($idUsuario) {
        $casosDeUso = DAOCasoDeUso::loadVisiveis($idUsuario);

        $dados = array();

        if ($casosDeUso != FALSE) {
            foreach ($casosDeUso as $casoDeUso) {
                $item ['item'] = $casoDeUso ['item'];
                $item ['linkJS'] = $casoDeUso ['linkJS'];
                $item ['descItem'] = $casoDeUso ['descItem'];
                $dados [$casoDeUso ['idCasoDeUso']] ['nome'] = $casoDeUso ['nome'];
                $dados [$casoDeUso ['idCasoDeUso']] ['descricao'] = $casoDeUso ['descricao'];
                $dados [$casoDeUso ['idCasoDeUso']] ['itens'] [] = $item;
            }
        }

        $_SESSION [self::KEY_CASOS_DE_USO] = serialize($dados);
    }

    public function unserializeCasosDeUso() {
        $casosDeUso = unserialize($_SESSION [self::KEY_CASOS_DE_USO]);
        return $casosDeUso;
    }

    public static function checkCookie() {

        PHP_COOKIE::extract("lembrar");

        if (isset($_COOKIE["login"])) {

            return true;
        }

        return false;
    }

    public static function entrarSistema($login, $senha, $lembrar) {
        $result = false;

        if (self::checkCookie()) {

            $res = self::execLoginCookie($_COOKIE["login"], $_COOKIE["senha"]);
        } else {

            $res = self::execLogin($login, $senha);
        }

        if ($res ['cod'] == self::LOGIN_OK) {

            if ($lembrar) {

                $cookie = new PHP_COOKIE("lembrar");
                $cookie->put("login", $login);
                $cookie->put("senha", Seguranca::createSenha($senha));
                $cookie->set();
            }

            $idUsuario = $res ['usuario'];
            if (self::loadFluxos($idUsuario)) {
                self::serializeInfoUsuario($idUsuario);
                self::serializeCasosDeUso($idUsuario);

                $daoSessao = new DAOSessao ( );
                $sessao = new Sessao ( );
                $sessao->setIdUsuario($idUsuario);
                $daoSessao->save($sessao);

                $result = self::ENTRADA_OK;
            } else {
                $result = self::SEM_FLUXOS;
            }
        } else {
            $result = self::LOGIN_ERRO;
        }

        return $result;
    }

    public static function sairSistema() {
        $daoSessao = new DAOSessao ( );
        $sessao = new Sessao ( );
        $sessao->setSessionId();
        $daoSessao->delete($sessao);

        unset($_SESSION [self::KEY_FLUXOS]);
        unset($_SESSION [self::KEY_CASOS_DE_USO]);
        unset($_SESSION [self::KEY_USUARIO]);

        $cookie = new PHP_COOKIE("lembrar");
        $cookie->clear();
        $cookie->set();

        Sessao::unsetChaveExtendida ();
    }

    public function checkPermissao($idFluxo) {
        $result ['ok'] = true;
        $result ['nomeFluxo'] = "";

        if ($idFluxo <= 0) {
            return $result;
        }

        $usuario = unserialize($_SESSION [self::KEY_USUARIO]);
        $fluxos = unserialize($_SESSION [ControleAcesso::KEY_FLUXOS]);

        if (!isset($fluxos [$idFluxo])) {
            $result ['ok'] = false;
            $result ['nomeFluxo'] = "Funcionalidade desconhecida";

            return $result;
        }

        $fluxo = $fluxos [$idFluxo];
        $priv = intval($fluxo ['priv']);
        $idUsuario = intval($usuario ['idUsuario']);

        if ($priv == $idUsuario) {
            return $result;
        } else {
            $result ['ok'] = false;
            $result ['nomeFluxo'] = $fluxo ['nome'];
        }

        return $result;
    }

    public static function testSessao() {
        $result = 0;
        DAOSessao::limparSessoesAntigas ();
        $daoSessao = new DAOSessao ( );
        $sessao = new Sessao ( );
        $sessao->setSessionId();
        try {
            $daoSessao->load($sessao);

            if ($sessao->isLoaded()) {
                if ($sessao->checkDuracao()) {
                    $daoSessao->update($sessao);
                    $result = self::SESSAO_OK;
                } else {
                    self::sairSistema ();
                    $result = self::SESSAO_EXPIRADA;
                }
            } else {
                self::sairSistema ();
                $result = self::SESSAO_EXCLUIDA;
            }
        } catch (Exception $e) {
            self::sairSistema ();
            $result = self::SESSAO_EXCLUIDA;
        }

        return $result;
    }

}

?>