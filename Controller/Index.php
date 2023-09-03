<?php
require_once('Kernel/View.php');
require_once('Config/Config.php');

/**
 * Contrôleur de la page d'accueil.
 */
class Index {

    /**
     * Fonction principale qui gère les requêtes et qui construit puis 
     * affiche la vue.
     */
    public function index() { 
        $view = new View();
        $view->setHead('head.html');
        $view->setHeader('header.html');
        $view->setMain('index.html');
        $view->setFooter('footer.html');
        $view->render([
            'textHeader' => 'Page d\'accueil',
            'pageName' => 'Paginaire - Accueil',
            'title' => 'Accueil',
            'endpoint' => Config::getEndpoint()
        ]);
    }
}
?>