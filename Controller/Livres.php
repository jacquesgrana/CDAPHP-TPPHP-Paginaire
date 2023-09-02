<?php
require_once('Kernel/View.php');
require_once('Config/Config.php');
require_once('Kernel/DBConnector.php');
require_once('Entity/Book.php');

class Livres {

    private int $limit = 12;
    private int $offset = 0;

    //private string $modalMode = "nothing";

    public function index() {
        //$_SESSION['modalMode'] = "nothing";
        //echo 'controller Index - fonction index';
        
        try {
            $books = Book::getAll($this->limit, $this->offset);
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
        $view->setMain('livres.html');
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
        // TODO Modifier
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
}
?>