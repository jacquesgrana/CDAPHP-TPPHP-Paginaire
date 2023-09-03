<?php

/**
 * Classe du routeur qui selon la querystring appelle le contrôleur
 * correspondant et appelle (ou non) la méthode passée (ou non) 
 * en paramètre.
 */
class Router
{
    private $controller;
    private $method;

    /**
     * Constructeur : vérifie l'existence du contrôleur 
     * et de la méthode demandés dans la querystring et 
     * affecte le contrôleur et la méthode.
     */
    public function __construct()
    {
        $this->controller = $_SERVER["DOCUMENT_ROOT"] . '/Controller/Index.php';
        $this->method = 'index';
        $isPageOk = false;
        if (isset($_GET['page'])) {
            $controllerFile = $_SERVER["DOCUMENT_ROOT"] . '/Controller/' . $_GET['page'] . '.php';
            if (file_exists($controllerFile)) {
                $this->controller = $controllerFile;
                include_once $this->controller;
                $isPageOk = true;
            }
        }

        if (isset($_GET['method']) && $isPageOk) {
            $className = basename($this->controller, '.php');
            $object = new $className();
            $methodName = $_GET['method'];
            if (method_exists($object, $methodName)) {
                $this->method = $methodName;
            }
        }
    }

    /**
     * Fonction qui instancie le contrôleur et appelle la méthode.
     */
    public function doRoute()
    {
        $method = $this->method;
        $className = basename($this->controller, '.php');
        $controller = new $className;
        $controller->$method();
    }
}
