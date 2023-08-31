<?php
class Index {

    public function index() {
        //echo 'controller Index - fonction index';
        require_once('Kernel/View.php');
        require_once('Config/Config.php');
        $view = new View();
        $view->setHead('head.html');
        $view->setHeader('header.html');
        $view->setMain('index.html');
        $view->setFooter('footer.html');
        $view->render([
            'textHeader' => 'Page d\'Accueil',
            'pageName' => 'Paginaire - Accueil',
            'var' => 'page index',
            'endpoint' => Config::getEndpoint()
        ]);
    }

    public function test() {
        echo 'controller Index - fonction test';
    }
}
?>