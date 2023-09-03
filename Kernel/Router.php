<?php
 /**
  * Classe du routeur qui selon la querystring appelle le contrôleur
  * correspondant et appelle (ou non) la méthode passée (ou non) 
  * en paramètre.
  */
class Router {
    private $controller;
    private $method;

    public function __construct()
    {
        $this->controller = $_SERVER["DOCUMENT_ROOT"] . '/Controller/Index.php';
        $this->method = 'index';

        if (isset($_GET['page'])) {  

            $this->controller = $_SERVER["DOCUMENT_ROOT"] . '/Controller/'.$_GET['page'].'.php';
            /*
            if(class_exists($_SERVER["DOCUMENT_ROOT"] . '/Controller/'.$_GET['page'])) {
                $this->controller = $_SERVER["DOCUMENT_ROOT"] . '/Controller/'.$_GET['page'].'.php';
            }*/
            
        }

        if (isset($_GET['method'])) {
            $this->method = $_GET['method'];
            /*
            if (method_exists($this->controller, $_GET['method'])) {
                $this->method = $_GET['method'];
            } 
            else {
                $this->controller = $_SERVER["DOCUMENT_ROOT"] . '/Controller/Index.php';
            }   */ 
        }
    }

    /**
     * Fonction qui instancie le contrôleur et appelle la méthode.
     */
    public function doRoute() {
        include_once $this->controller;
        $method = $this->method;
        $className = basename($this->controller, '.php');
        $controller = new $className;
        $controller->$method();
    }
}
