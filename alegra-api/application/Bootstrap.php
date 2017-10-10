<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initRoutes()
    {
       $front = Zend_Controller_Front::getInstance();
    
        $router = $front->getRouter();
    
        $restRoute = new Zend_Rest_Route($front);
        $router->addRoute('default', $restRoute);

        $this->_initApiCredentials();
    }
    public function _initApiCredentials()
	{
	    $username_api = $this->getOption('username_api');
	    Zend_Registry::set('username_api', $username_api);

	    $password_api = $this->getOption('password_api');
	    Zend_Registry::set('password_api', $password_api);
	}
}

