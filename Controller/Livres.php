<?php
class Livres {

    public function index() {
        //echo 'controller Index - fonction index';
        require_once('Kernel/View.php');
        require_once('Config/Config.php');
        require_once('Kernel/DBConnector.php');
        require_once('Entity/Book.php');
        try {
            //$connexion = DBConnector::getConnect();
            $books = Book::getAll();
            /*
            $books = [];
            foreach($booksTab as $tab) {
                $books[] = new Book(
                    $tab['id'],
                    $tab['title'],
                    $tab['author'],
                    $tab['type'],
                    $tab['image'],
                    $tab['description']
                );
            }*/
            //var_dump($books);
            $book = Book::getById(9785678901234)[0];
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
            'book' => $book,
            'endpoint' => Config::getEndpoint()
        ]);
    }
/*
    public static function getAll()
    {
        $sql = "select * from books";
        return self::Execute($sql);
    }

    private static function Execute($sql)
    {
        $pdostatement = DBConnector::getConnect()->query($sql);
        return $pdostatement->fetchAll(\PDO::FETCH_DEFAULT);
    }
*/
    public function test() {
        echo 'controller Livres - fonction test';
    }
}
?>