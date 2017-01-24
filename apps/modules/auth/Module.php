<?php
namespace LIPARENT\Auth;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DiInterface;
use Phalcon\Mvc\View;
use Phalcon\Events\Manager as EventsManager;

class Module
{


	public function registerAutoloaders()
	{

		$loader = new Loader();

		$loader->registerNamespaces(array(
			'LIPARENT\Auth'   => APP_PATH .'apps/modules/auth/classes/',
			'LIPARENT\Common'      => APP_PATH .'apps/common/classes/',
		));

		$loader->register();
	}

	/**
	 * Register the services here to make them general or register in the Module
	 * Definition to make them module-specific
	 */
	public function registerServices(DiInterface $di)
	{		
				
		$dispatcher = $di->get("dispatcher");
		
		//Registering a dispatcher
		$di->set('dispatcher', function() {
			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace("LIPARENT\Auth\Controllers");
			return $dispatcher;
		});

		$di->set('view', function() {
	        $view = new View(); 
			$view->setViewsDir( APP_PATH . 'apps/modules/auth/views/');	
			// $view->setMainView('auth_layout');
			$view->setLayoutsDir('../../../common/views/templates/default/');		    
		    $view->setTemplateAfter('auth_layout');

	        return $view;
	    });
		
		$di->set('_view', function () {
		    $view = new View(); 
			$view->setViewsDir( APP_PATH . 'apps/modules/auth/views/');		
		    		    

		    return $view;
		}, true);	
	}
}
