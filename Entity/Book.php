<?php
require_once('Model.php');

/**
 * Classe de l'entité 'Book' qui représente un livre de la bdd.
 */
class Book extends Model {
    private int $id;
    private string $title;
    private string $author;
    private string $type;
    private string $image;
    private string $description;
    protected static $tableName = 'books';

    /**
     * Getters et Setters.
     */
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getType() {
        return $this->type;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setAuthor($author) {
        $this->author = $author;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
}
?>