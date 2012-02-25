<?php
require_once 'classes/base/controle/MensagemAction.class.php';
require_once 'classes/base/controle/MapAction.class.php';
require_once 'classes/base/controle/RawRequest.class.php';
require_once 'classes/base/controle/AjaxResponse.class.php';

abstract class ApplicationManagerAbstract
{
	private static $requestFilters;
	private static $actionRequestFilters;
	
	public function __construct()
	{
		self::$requestFilters = array ( );
		self::$actionRequestFilters = array ( );
		
		$this->initRequestFilters();
		$this->initMapActions();
	}
	
	public function addFilter($class, $exception, $actionException)
	{
		self::$requestFilters [] = $class;
		self::$actionRequestFilters [$exception] = $actionException;
	}
	
	abstract function initRequestFilters();
	
	abstract function initMapActions();
	
	private function aplicarFilters($request)
	{
		$action = null;
		try
		{
			foreach ( self::$requestFilters as $classFilter )
			{
				call_user_func(array ($classFilter, "execute" ), $request);
			}
		} catch ( Exception $e )
		{
			$class = get_class($e);
			if ($class == 'ActionNotExistException')
			{
				$classAction = "MensagemAction";
			} else
			{
				$classAction = self::$actionRequestFilters [$class];
			}
			$action = MapAction::getAction($classAction);
			$action->setRequest($e);
		}
		
		return $action;
	}
	
	public function run()
	{
		$response = null;
		$rawRquest = new RawRequest();
		$action = $this->aplicarFilters($rawRquest);
		
		if ($action === null)
		{
			try
			{
				$action = MapAction::getAction($rawRquest->getAction());
				
				$action->setRequest($rawRquest);
				$action->execute();
				$response = $action->getResponse();
			} catch ( ActionNotExistException $e )
			{
				$response = new AjaxResponse();
				$response->addAlert("Acao inexistente");
			}
		} else
		{
			$action->execute();
			$response = $action->getResponse();
		}
		
		$response->toBrowser();
	}

}

?>