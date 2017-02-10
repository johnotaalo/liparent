<?php
namespace LIPARENT\Tenant;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;

class Module
{

	public function registerAutoloaders()
	{

		$loader = new Loader();

		$loader->registerNamespaces(array(
			'LIPARENT\Tenant' => APP_PATH .'apps/modules/tenant/classes/',
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
			$dispatcher->setDefaultNamespace("LIPARENT\Tenant\Controllers");
			return $dispatcher;
		});	

		$di->set('view', function() {
	        $view = new View(); 
			$view->setViewsDir( APP_PATH . 'apps/modules/tenant/views/');	
			// $view->setMainView('auth_layout');
			$view->setLayoutsDir('../../../common/views/templates/default/');		    
		    $view->setTemplateAfter('tenant_layout');

	        return $view;
	    });
		
		$di->set('_view', function () {
		    $view = new View(); 
			$view->setViewsDir( APP_PATH . 'apps/modules/tenant/views/');		
		    		    

		    return $view;
		}, true);

		$di->set('assets', function() {
			$assets = new \Phalcon\Assets\Manager();

			$assets->collection('js');
			$assets->collection('css');
			
			return $assets;
		});

		$di->set('mail', function(){
			return new \LIPARENT\Library\Mail();
		});

		$di->set('flash', function(){
			return new FlashDirect([
				'success'	=>	'alert alert-success'
			]);
		});

		$di->set('flashSession', function(){
			return new FlashSession();
		});
	}
	
}
