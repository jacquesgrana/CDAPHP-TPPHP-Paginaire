<?php
require_once('Kernel/View.php');
require_once('Config/Config.php');
require_once('Kernel/DBConnector.php');
require_once('Entity/Book.php');

/**
 * Contrôleur de la page d'affichage des livres.
 */
class Livres {

    private int $limit = 10;
    private int $offset = 0;
    private int $page = 0;
    private int $maxPage = 0;

    /**
     * Fonction principale qui gère les requêtes et qui construit 
     * puis affiche la vue.
     */
    public function index() {
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
            switch ($action) {
                case 'previous':
                    $_SESSION['page'] = isset($_SESSION['page']) ? $_SESSION['page'] - 1 : 0;
                    break;
                case 'next':
                    $_SESSION['page'] = isset($_SESSION['page']) ? $_SESSION['page'] + 1 : 0;
                    break;
                default:
                    break;
            }
            if(isset($_SESSION['page'])) $this->page = $_SESSION['page'];
            if($this->page < 0) $this->page = 0;
            if(isset($_SESSION['bookNb'])) {
                $nb = $_SESSION['bookNb'];
                $maxPage = $nb / $this->limit;
                $this->maxPage = $maxPage;
                if($this->page > $maxPage) $this->page = intval($this->maxPage);
            }
            $this->offset = $this->limit * $this->page;
            $_SESSION['page'] = $this->page;
        }
        
        try {
            $books = Book::getAll($this->limit, $this->offset);
            $_SESSION['bookNb'] = count(Book::getAll(2147483647,0));
            $nb = $_SESSION['bookNb'];
            $_SESSION['maxPage'] = intval($nb / $this->limit);
            $_SESSION['page'] = $this->page;
        } 
        catch(\PDOException $e) {
            die($e->getMessage());
        }
        $view = new View();
        $view->setHead('head.html');
        $view->setHeader('header.html');
        $view->setMain('livres.php');
        $view->setFooter('footer.html');
        $view->render([
            'textHeader' => 'Page des livres',
            'pageName' => 'Paginaire - Livres',
            'books' => $books,
            'page' => $_SESSION['page'],
            'maxPage' => $_SESSION['maxPage'],
            'endpoint' => Config::getEndpoint()
        ]);
    }

    /**
     * Fonction qui met à jour un livre dans le bdd.
     */
    public function update() {
        if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['type']) && isset($_POST['image']) && isset($_POST['description']) && isset($_GET['id'])) 
        {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $type = $_POST['type'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $datas = ["title" => $title, "author" => $author, "type" => $type, "image" => $image, "description" => $description];
            $id = intval($_GET['id']);
            $ok = Book::update($id, $datas);
            self::index();
        }
    }

    /**
     * Fonction qui créé et insère un livre dans la bdd.
     */
    public function create() {
        if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['type']) && isset($_POST['image']) && isset($_POST['description']) && isset($_POST['isbn'])) 
        {
            $id = intval($_POST['isbn']);
            $title = $_POST['title'];
            $author = $_POST['author'];
            $type = $_POST['type'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $datas = ["id" => $id, "title" => $title, "author" => $author, "type" => $type, "image" => $image, "description" => $description];
            $ok = Book::insert($datas);
            self::index();
        }
    }

    /**
     * Fonction qui efface un livre de la bdd.
     */
    public function delete() {
        if (isset($_GET['id']))
        {
            $id = intval($_GET['id']);
            $sok = Book::delete($id);
            self::index();
        }
    }
}
?>