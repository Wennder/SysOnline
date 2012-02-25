<?php

require_once 'classes/base/sistema/ListagemUtil.class.php';
require_once 'classes/base/interface/ObjectGUI.class.php';
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/controle/FormErrorResponse.class.php';
require_once 'classes/modelo/admin/entidade/curso/DAOCurso.class.php';
require_once 'classes/base/sistema/Seguranca.class.php';
require_once 'classes/modelo/admin/controle/curso/GestaoCurso.class.php';

class ExecListCursoAction extends AbstractAction {

    protected $tplLista = 'curso/tabelaCurso.tpl';
    protected $tplMsg = 'curso/tabelaCursoMsg.tpl';
    protected $containerLista = 'lista_curso';

    public function execute() {
        $response = new FormErrorResponse ( );

        $rawRequest = $this->getRequest();

        $controlValidation = GestaoCurso::validateRequestList($rawRequest);

        if ($controlValidation->isValid()) {
            $cleanRequest = $controlValidation->getCleanRequest();

            $pag = ($cleanRequest->get('pag') > 0) ? intval($cleanRequest->get('pag')) : 1;

            $params ['curso'] = $cleanRequest->get('curso');
            $params ['ordem'] = $cleanRequest->get('ordem');
            $params ['sentido'] = $cleanRequest->get('sentido');

            $params ['li'] = (($pag - 1) * GestaoCurso::NUM_ITENS);

            $filtro = GestaoCurso::filtroBasico($params);

            $lista = ListagemUtil::execListagem($filtro);

            if ($lista ['numItens'] > 0) {
                $total = DAOCurso::countTotal ();
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
