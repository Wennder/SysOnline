<?php

require_once 'classes/base/sistema/ListagemUtil.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/usuarios/DAOUsuario.class.php';
require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/modelo/admin/controle/usuarios/GestaoUsuarios.class.php';

class ExecListUsuariosAction extends AbstractAction {

    protected $tplLista = 'usuarios/tabelaUsuarios.tpl';
    protected $tplMsg = 'usuarios/tabelaUsuariosMsg.tpl';
    protected $containerLista = 'lista_usuarios';

    public function execute() {
        $response = new FormErrorResponse ( );

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoUsuarios::validateRequestList($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $pag = ($cleanRequest->get('pag') > 0) ? intval($cleanRequest->get('pag')) : 1;

            $params ['usuario'] = $cleanRequest->get('usuario');
            $params ['ordem'] = $cleanRequest->get('ordem');
            $params ['sentido'] = $cleanRequest->get('sentido');

            $params ['li'] = (($pag - 1) * GestaoUsuarios::NUM_ITENS);

            $filtro = GestaoUsuarios::filtroBasico($params);

            $lista = ListagemUtil::execListagem($filtro);

            if ($lista ['numItens'] > 0) {
                $total = DAOUsuario::countTotal ();
                $tela = new ObjectGUI($this->tplLista);

                $lista ['itens'] = Seguranca::stripslashes($lista ['itens']);

                $tela->assign("arrayItens", $lista ['itens']);

                $tela->assign("paginacao", ListagemUtil::getHTMLPaginacao($cleanRequest->getData(), $lista ['numPags']));
                $tela->assign("total", $total);
                $tela->assign("retornados", $lista ['numItens']);

                $response->addAssign($this->containerLista, "innerHTML", $tela->getHTML());
            } else {
                $tela = new ObjectGUI($this->tplMsg);
                $response->addAssign($this->containerLista, "innerHTML", $tela->getHTML());
            }
        } else {
            $response->addAlert($controlValidation->getErrosAsString());
        }

        $this->setResponse($response);
    }
}

?>
