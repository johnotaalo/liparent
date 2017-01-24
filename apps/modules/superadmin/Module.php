<?php
namespace LIPARENT\Superadmin;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;

class Module
{

	public function registerAutoloaders()
	{

		$loader = new Loader();

		$loader->registerNamespaces(array(
			'LIPARENT\Superadmin' => APP_PATH .'apps/modules/superadmin/classes/',
		));

		$loader->register();
	}

	/**
	 * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
	 */
	public function registerServices(DiInterface $di)
	{

		//Registering a dispatcher
		$di->set('dispatcher', function() {
			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace("LIPARENT\Superadmin\Controllers");
			return $dispatcher;
		});	

		$di->set('view', function() {
	        $view = new View(); 
			$view->setViewsDir( APP_PATH . 'apps/modules/superadmin/views/');	
			// $view->setMainView('auth_layout');
			$view->setLayoutsDir('../../../common/views/templates/default/');		    
		    $view->setTemplateAfter('layout');

	        return $view;
	    });
		
		$di->set('_view', function () {
		    $view = new View(); 
			$view->setViewsDir( APP_PATH . 'apps/modules/superadmin/views/');		
		    		    

		    return $view;
		}, true);

		$di->set('mail', function(){
			return new \LIPARENT\Library\Mail();
		});
	}
	
}
