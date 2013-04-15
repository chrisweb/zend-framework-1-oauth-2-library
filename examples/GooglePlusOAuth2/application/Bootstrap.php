<?php

/**
 * Application Bootstrap
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoloader()
    {
        
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Chrisweb');
        
    }
    
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
    }
    
    protected function _initRouting()
    {
        
        //Zend_Debug::dump(APPLICATION_PATH.'/configs/routes.ini');
        //exit;

        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/routes.ini');
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();
        $router->addConfig($config, 'routes');
        Zend_Controller_Front::getInstance()->setRouter($router);
        
    }

}