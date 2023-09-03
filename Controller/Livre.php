<?php
require_once('Kernel/View.php');
require_once('Config/Config.php');
require_once('Kernel/DBConnector.php');
require_once('Entity/Book.php');

/**
 * Contrôleur de la page de consultation/édition/création d'un livre.
 */
class Livre {
    private string $actionText = "Créer un livre";
    private string $action = "default";
    private ?int $id = null;
    private ?Book $book = null;

    /**
     * Fonction principale qui gère les requêtes et qui construit puis 
     * affiche la vue.
     */
    public function index() {
        if(isset($_GET['action'])) {
            $this->action = $_GET['action'];
            switch ($this->action) {
                case 'view' :
                    $this->actionText = "Afficher un livre";
                    if(isset($_GET['id'])) {
                        $this->id = $_GET['id'];
                        $this->book = Book::getById($this->id)[0];
                    }
                 break;  
                 case 'edit' :
                    $this->actionText = "Modifier un livre";
                    if(isset($_GET['id'])) {
                        $this->id = $_GET['id'];
                        $this->book = Book::getById($this->id)[0];
                    }
                 break; 
            }
        }

        $view = new View();
        $view->setHead('head.html');
        $view->setHeader('header.html');
        $view->setMain('livre.php');
        $view->setFooter('footer.html');
        $view->render([
            'textHeader' => 'Page d\'un livre',
            'pageName' => 'Paginaire - Livre',
            'actionText' => $this->actionText,
            'action' => $this->action,
            'id' => $this->id,
            'book' => $this->book,
            'endpoint' => Config::getEndpoint()
        ]);
    }
}
?>