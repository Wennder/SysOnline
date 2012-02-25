<?php
require_once 'classes/base/controle/AbstractAction.class.php';
require_once 'classes/base/sistema/UploadFile.class.php';
require_once 'classes/base/controle/validacao/NoValidator.class.php';
require_once 'classes/base/controle/validacao/StringNotEmptyValidator.class.php';
require_once 'classes/base/controle/validacao/ExtensaoArquivoValidator.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';
require_once 'include/include.init.php';
require_once 'classes/base/controle/validacao/ValidationFacade.class.php';

class UploadArquivoAction extends AbstractAction
{
	public function execute()
	{
		$response = new AjaxResponse();
		$response->sendAsHTML();
		
		$rawRequest = $this->getRequest();
		$controlValidation = new ValidationFacade();
		
                $controlValidation->addValidator ( new ExtensaoArquivoValidator ( 'arquivo', array ('pdf'), 'O tipo de arquivo enviado não é aceito.' ) );
		$controlValidation->addValidator(new StringNotEmptyValidator("idFormUpload", "Falta informar o id do form usado para o upload"));
		$controlValidation->addValidator(new StringNotEmptyValidator("idParentInput", "Falta informar o id do input do arquivo"));
		$controlValidation->addValidator(new StringNotEmptyValidator("inputDestArquivo", "Falta informar o id do input de destino do arquivo"));
		
		$controlValidation->validate($rawRequest);
		
		if ($controlValidation->isValid())
		{
			$cleanRequest = $controlValidation->getCleanRequest();
			
			$params ['diretorio'] = DIR_TEMP;
			$params ['arquivo'] = $rawRequest->getForValidation('arquivo');

			$updFile = new UploadFile($params);
			
			$updFile->saveToDisk();
			
			$idFormUpload = $cleanRequest->get('idFormUpload');
			$idParentInput = $cleanRequest->get('idParentInput');
			$inputDestArquivo = $cleanRequest->get('inputDestArquivo');
			
			$nameFile = $updFile->getNome();
			$srcFile = "../temp/" . $updFile->getNome();
			$mimeFile = $updFile->getMime();
						
			$response->addScript("parent.js.confirmUpload({idFormUpload:'{$idFormUpload}', idParentInput:'{$idParentInput}', inputDestArquivo:'{$inputDestArquivo}', nameFile:'{$nameFile}',	srcFile:'{$srcFile}', mime:'{$mimeFile}'})");
		} else
		{
			$erros = $controlValidation->getErrors();
			
			$controlValidation = new ValidationFacade();
			
			$controlValidation->addValidator(new StringNotEmptyValidator("idFormUpload", "Falta informar o id do form usado para o upload"));
			$controlValidation->addValidator(new StringNotEmptyValidator("inputDestArquivo", "Falta informar o id do input de destino do arquivo"));
			
			$controlValidation->validate($rawRequest);
			if ($controlValidation->isValid())
			{
				$cleanRequest = $controlValidation->getCleanRequest();
				
				$idFormUpload = $cleanRequest->get('idFormUpload');
				$inputDestArquivo = $cleanRequest->get('inputDestArquivo');
				
				$msg = "";
				
				foreach ( $erros as $erro )
				{
					$msg .= $erro . "<br />\n";
				}
				
				$response->addScript("parent.js.cancelUpload({idFormUpload:'{$idFormUpload}', inputDestArquivo:'{$inputDestArquivo}'})");
				$response->addScript("parent.js.promptMenssage('Upload de Imagens', '{$msg}')");
			} else
			{
				$response->addScript("parent.js.promptMenssage('Upload de Imagens', 'Algumas inforações básicas não foram enviadas pelo sistema e esta operação não pode ser completada.')");
			}
		}
		
		$this->setResponse($response);
	}
}

?>