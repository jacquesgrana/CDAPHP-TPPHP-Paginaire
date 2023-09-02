<?php
require_once('Kernel/View.php');
require_once('Config/Config.php');
require_once('Kernel/DBConnector.php');
require_once('Entity/Book.php');

class Livre {
    private string $actionText = "default";
    private string $action = "default";
    private ?int $id = null;
    private ?Book $book = null;

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
            }

        }


        $view = new View();
        $view->setHead('head.html');
        $view->setHeader('header.html');
        $view->setMain('livre.html');
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