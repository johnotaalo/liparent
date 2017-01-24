<?php
namespace LIPARENT;

error_reporting(E_ALL);
define('APP_PATH', realpath('..') . '/');
date_default_timezone_set('Africa/Nairobi');

use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\Application as BaseApplication;
use Phalcon\Mvc\Dispatcher as PhDispatcher;
use Phalcon\Db\Adapter\Pdo\Mysql as MySQLAdapter;
use LIPARENT\Library\SecurityPlugin;
use Phalcon\Flash\Direct as FlashDirect;

class Application extends BaseApplication
{
	
	/**
	 * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
	 */
	protected function registerServices()
	{

		$di = new FactoryDefault();

		$loader = new Loader();

		$loader->registerNamespaces(array(			
			'LIPARENT\Library'      => APP_PATH . 'apps/library/',
			'LIPARENT\Common'      =>  APP_PATH . 'apps/common/classes/',
		));

		/**
		 * Read configuration
		 */
		//$config = include __DIR__ . "/../apps/config/config.php";

		$config = new \Phalcon\Config\Adapter\Php(APP_PATH . 'apps/config/config.php'); 
		$di->set('config', $config);


		/**
		 * We're a registering a set of directories taken from the configuration file
		 */
		
		$loader->registerDirs(
			array(
				APP_PATH . 'apps/library/',
			)
		)->register();
		

		/**
	     * MVC dispatcher
	     */
	    $di->setShared('dispatcher', function () {

	        $eventsManager = new EventsManager;

	        /**
	         * Check if the user is logged in
	         */
	        // $eventsManager->attach('dispatch:beforeDispatchLoop', new SecurityPlugin);

	        /**
	         * Handle exceptions and not-found exceptions using NotFoundPlugin
	         */
	        //$eventsManager->attach('dispatch:beforeException', new \Pims\Library\NotFoundPlugin);

	        $dispatcher = new PhDispatcher;
	        
	        // $dispatcher->setEventsManager($eventsManager);

	        return $dispatcher;
	    });
		
				

		$di->set('view', function() {
	        $view = new View(); 
			$view->setViewsDir( APP_PATH . 'apps/common/views/templates/default/');	
			$view->setMainView('layout');

	        return $view;
	    }, true);

	    $di->set('commonv', function() {						
			 $view = new View(); 
	        return $view;
		});

		$di->set('commonsections', function() {
			$view = new View();
			$view->setViewsDir( APP_PATH . 'apps/common/views/templates/default/sections');

			return $view;
		});

		//Registering a router
		$di->set('router', function(){

			$router = new Router();

			$router->removeExtraSlashes(true);

			$router->setDefaultModule("auth");

			$router->add('/', array(
				'module'     => 'auth',
				'controller' => 'home',
				'action'     => 'index',
			));

			$router->add('/:module', array(
				'module'     => 1,
				'controller' => 'home',
				'action'     => 'index',
			));

			$router->add('/:module/:controller', array(
				'module'     => 1,
				'controller' => 2,
				'action'     => 'index',
			));

			$router->add('/:module/:controller/:action/:params', array(
				'module'     => 1,
				'controller' => 2,
				'action'     => 3,
				'params'     => 4
			));
			
			return $router;

		});

		$di->set('assets', function() {
            $assets = new \Phalcon\Assets\Manager();
            $assets
                ->collection('js')
                ->addJs('vendors/bower_components/jquery/jquery.min.js', true)
                ->addJs('vendors/bower_components/bootstrap/js/bootstrap.min.js', true)

                ->addJs('vendors/bower_components/flot/jquery.flot.js', true)
                ->addJs('vendors/bower_components/flot/jquery.flot.resize.js', true)
                ->addJs('vendors/bower_components/flot.curvedlines/curvedLines.js', true)
                ->addJs('vendors/sparklines/jquery.sparkline.min.js', true)
                ->addJs('vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js', true)

                ->addJs('vendors/bower_components/moment/min/moment.min.js', true)
                ->addJs('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js', true)
                ->addJs('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js', true)
                ->addJs('vendors/bower_components/Waves/dist/waves.min.js', true)
                ->addJs('vendors/bootstrap-growl/bootstrap-growl.min.js', true)
                ->addJs('vendors/bower_components/sweetalert/dist/sweetalert.min.js', true)
                ->addJs('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js', true)

                ->addJs('js/app.min.js', true)

            ;
            $assets
                ->collection('css')
                ->addCss('vendors/bower_components/fullcalendar/dist/fullcalendar.min.css', true, true)
                ->addCss('vendors/bower_components/animate.css/animate.min.css', true, true)
                ->addCss('vendors/bower_components/sweetalert/dist/sweetalert.css', true, true)
                ->addCss('vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css', true, true)
                ->addCss('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css', true, true)

                ->addCss('css/app_1.min.css', true, true)
                ->addCss('css/app_2.min.css', true, true)
                ->addCss('css/custom.css', true, true)
            ;

            return $assets;
        });

        $di->set('url', function() use ($config) {
			$url = new \Phalcon\Mvc\Url();
			$url->setBaseUri( $config->app->base_url );
			return $url;
		});

		$di->set('flash', function () {
		    $flash = new FlashDirect(
		        array(
		            'error'   => 'alert alert-danger alert-dismissable',
		            'success' => 'alert alert-success alert-dismissable',
		            'notice'  => 'alert alert-info alert-dismissable',
		            'warning' => 'alert alert-warning alert-dismissable'
		        )
		    );

		    return $flash;
		});

		

	    /**
	     * Start the session the first time some component request the session service
	     */
	    
	    $di->setShared('session', function () {		
	        $session = new SessionAdapter();        
			$session->start();
	        return $session;
	    });

	    

	    /**
		 * Database connection is created based in the parameters defined in the configuration file
		 */		
		$di->set('db', function () use ($config) {	    	
	        $db = new MySQLAdapter([
	        		"host" => $config->db->host,
					"username"  => $config->db->username,
					"password"  => $config->db->password,
					"dbname"    => $config->db->name,
					"options"   => [
						\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
					]
	        	]
	        );

	        return $db;
	    });


		$this->setDI($di);
	}

	public function main()
	{

		try 
		{

			$this->registerServices();

			//Register the installed modules
			$this->registerModules(array(
				'auth' => array(
					'className' => 'LIPARENT\Auth\Module',
					'path' => APP_PATH .'apps/modules/auth/Module.php'
				),
				'tenant' => array(
					'className' => 'LIPARENT\Tenant\Module',
					'path' => APP_PATH .'apps/modules/tenant/Module.php'
				),
				'landlord' => array(
					'className' => 'LIPARENT\Landlord\Module',
					'path' => APP_PATH .'apps/modules/landlord/Module.php'
				),
				'admin' => array(
					'className' => 'LIPARENT\Admin\Module',
					'path' => APP_PATH .'apps/modules/admin/Module.php'
				),
				'superadmin' => array(
					'className' => 'LIPARENT\Superadmin\Module',
					'path' => APP_PATH .'apps/modules/superadmin/Module.php'
				)
			));

			echo $this->handle()->getContent();

		} catch (\Exception $e) {
			echo 'Exception: ', $e->getMessage();
			echo '<pre>' . $e->getTraceAsString() . '</pre>';
		}
	}

}


$application = new Application();
$application->main();