<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class ContactsController extends MyRest_Controller
{
    /*public function cors()
    {
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
    }*/
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        /*$this->cors();*/
    }
    
    public function indexAction()
    {
        $username_api = Zend_Registry::get('username_api');
        $password_api = Zend_Registry::get('password_api');

        $curl = curl_init();
        $url = "https://app.alegra.com/api/v1/contacts/";
        $options = array(
            CURLOPT_HTTPAUTH =>CURLAUTH_BASIC,
            CURLOPT_USERPWD =>$username_api .":". $password_api,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_HTTPHEADER => array('Accept: application/json'),
            CURLOPT_SSL_VERIFYPEER => false
        );
        curl_setopt_array($curl, $options);      
        $result = curl_exec($curl);
        curl_close($curl);

        $response = $result;

        $this->getResponse()->setBody($response);
        $this->getResponse()->setHttpResponseCode(200)
                            ->setHeader('Content-Type', 'application/json');
    }

    public function getAction()
    {    
        $username_api = Zend_Registry::get('username_api');
        $password_api = Zend_Registry::get('password_api');

        $contact_id = $this->_request->getParam('id');

        $curl = curl_init();
        $url = "https://app.alegra.com/api/v1/contacts/$contact_id";
        $options = array(
            CURLOPT_HTTPAUTH =>CURLAUTH_BASIC,
            CURLOPT_USERPWD =>$username_api .":". $password_api,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_HTTPHEADER => array('Accept: application/json'),
            CURLOPT_SSL_VERIFYPEER => false
        );
        curl_setopt_array($curl, $options);           
        $result = curl_exec($curl);
        curl_close($curl);        

        $this->getResponse()->setBody($result);
        $this->getResponse()->setHttpResponseCode(200)
                            ->setHeader('Content-Type', 'application/json');   
     
    }

    public function postAction()
    {   
        $username_api = Zend_Registry::get('username_api');
        $password_api = Zend_Registry::get('password_api');

        # Get JSON as a string
        $json_str = file_get_contents('php://input');

        $curl = curl_init();
        $url = "https://app.alegra.com/api/v1/contacts/";
        $options = array(
            CURLOPT_HTTPAUTH =>CURLAUTH_BASIC,
            CURLOPT_USERPWD =>$username_api .":". $password_api,
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_HTTPHEADER => array('Accept: application/json'),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS=> ($json_str)
        );
        curl_setopt_array($curl, $options);
        
        $result = curl_exec($curl);

        curl_close($curl);
        $this->getResponse()->setBody($result);
        $this->getResponse()->setHttpResponseCode(200)
                            ->setHeader('Content-Type', 'application/json');
        
    }

    public function putAction()
    {   
        $username_api = Zend_Registry::get('username_api');
        $password_api = Zend_Registry::get('password_api');

       $contact_id = $this->_request->getParam('id');

        # Get JSON as a string
        $json_str = file_get_contents('php://input');



        $curl = curl_init();
        $url = "https://app.alegra.com/api/v1/contacts/$contact_id";
        $options = array(
            CURLOPT_HTTPAUTH =>CURLAUTH_BASIC,
            CURLOPT_USERPWD =>$username_api .":". $password_api,
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_HTTPHEADER => array('Accept: application/json'),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS=> ($json_str)
        );
        curl_setopt_array($curl, $options);
        
        $result = curl_exec($curl);

        curl_close($curl);
        /*echo http_build_query($params) ;*/
        $this->getResponse()->setBody($result);
        $this->getResponse()->setHttpResponseCode(200)
                            ->setHeader('Content-Type', 'application/json');
    }

    public function deleteAction()
    {
        $username_api = Zend_Registry::get('username_api');
        $password_api = Zend_Registry::get('password_api');
        
        $contact_id = $this->_request->getParam('id');

        $curl = curl_init();
        $url = "https://app.alegra.com/api/v1/contacts/$contact_id";
        $options = array(
            CURLOPT_HTTPAUTH =>CURLAUTH_BASIC,
            CURLOPT_USERPWD =>$username_api .":". $password_api,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_HTTPHEADER => array('Accept: application/json'),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "DELETE"
        );
        curl_setopt_array($curl, $options);
        
        $result = curl_exec($curl);

        curl_close($curl);

        $response = $result;

        $this->getResponse()->setBody($response);
        $this->getResponse()->setHttpResponseCode(200)
                            ->setHeader('Content-Type', 'application/json');
        
    }
}