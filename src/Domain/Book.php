<?php

namespace MicroCMS\Domain;

class Book 
{
    /**
     * Book id.
     *
     * @var integer
     */
    private $id;

    /**
     * Book title.
     *
     * @var integer
     */
    private $title;

    /**
     * Book isbn.
     *
     * @var integer
     */
    private $isbn;

    /**
     * Book summary.
     *
     * @var integer
     */
    private $summary;
    
    /**
     * Associated author.
     *
     * @var \MicroCMS\Domain\Author
     */
    private $author;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
        return $this;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
        return $this;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(Author $author) {
        $this->author = $author;
        return $this;
    }
}