<?php
require_once('Kernel/View.php');
require_once('Config/Config.php');
require_once('Kernel/DBConnector.php');
require_once('Entity/Book.php');

class Livres {

    private int $limit = 10;
    private int $offset = 0;
    private int $page = 0;
    //private ?int $bookNb = null;

    //private string $modalMode = "nothing";

    public function index() {
        // TODO faire requete pour avoir le nombre de livres pour determiner le nombre max de pages
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
                    // Gérer les autres cas si nécessaire
                    break;
            }
            if(isset($_SESSION['page'])) $this->page = $_SESSION['page'];
            if($this->page < 0) $this->page = 0;
            // TODO caper page pour le max
            if(isset($_SESSION['bookNb'])) {
                $nb = $_SESSION['bookNb'];
                $maxPage = $nb / $this->limit;
                if($this->page > $maxPage) $this->page = intval($maxPage);
            }
            $this->offset = $this->limit * $this->page;
            $_SESSION['page'] = $this->page;
            //var_dump($this->page);
            //var_dump($_SESSION['bookNb']);
            //var_dump($this->offset);
        }
        
        try {
            $books = Book::getAll($this->limit, $this->offset);
            $_SESSION['bookNb'] = count(Book::getAll(2147483647,0));
            //var_dump($books);
            //$book = Book::getById(9785678901234)[0];
        } 
        catch(\PDOException $e) {
            die($e->getMessage());
        }

        
        
        //var_dump($connexion);
        
        $view = new View();
        $view->setHead('head.html');
        $view->setHeader('header.html');
        $view->setMain('livres.php');
        $view->setFooter('footer.html');
        $view->render([
            'textHeader' => 'Page des livres',
            'pageName' => 'Paginaire - Livres',
            'books' => $books,
            //'modalMode' => $this->modalMode,
            //'book' => $book,
            'endpoint' => Config::getEndpoint()
        ]);
    }

    /*
    public function test() {
        echo 'controller Livres - fonction test';
    }
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
            //var_dump($datas);
            $id = intval($_GET['id']);
            //var_dump($id);
            $ok = Book::update($id, $datas);
            self::index();
        }
    }

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

    public function delete() {
        if (isset($_GET['id'])) // && isset($_GET['confirm'])
        {
            $id = intval($_GET['id']);
            $sok = Book::delete($id);
            self::index();
        }
    }
}
?>