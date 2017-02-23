<?php

namespace MicroCMS\DAO;

use MicroCMS\Domain\Book;

class BookDAO extends DAO 
{
    /**
     * @var \MicroCMS\DAO\AuthorDAO
     */
    private $authorDAO;

    public function setAuthorDAO(AuthorDAO $authorDAO) {
        $this->authorDAO = $authorDAO;
    }

    /**
     * Return a list of all books, sorted by title.
     *
     * @return array A list of all Authors.
     */
    public function findAll() {
        $sql = "select * from book order by book_title";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $books[$bookId] = $this->buildDomainObject($row);
        }
        return $books;
    }

    /**
     * Return a list of all books for an author, sorted by book_title.
     *
     * @param integer $authorId The author id.
     *
     * @return array A list of all books for the author.
     */
    public function findAllByauthor($authorId) {
        // The associated author is retrieved only once
        $author = $this->authorDAO->find($authorId);

        // art_id is not selected by the SQL query
        // The author won't be retrieved during domain objet construction
        $sql = "select book_id, book_title, book_isbn, book_summary from book where auth_id=? order by book_id";
        $result = $this->getDb()->fetchAll($sql, array($authorId));

        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $book = $this->buildDomainObject($row);
            // The associated author is defined for the constructed book
            $book->setAuthor($author);
            $books[$comId] = $book;
        }
        return $books;
    }

    /**
     * Creates an Book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \MicroCMS\Domain\Book
     */
    protected function buildDomainObject(array $row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);
        //$book->setAuthor($row['auth_id']);

        if (array_key_exists('auth_id', $row)) {
            // Find and set the associated author
            $authorId = $row['book_id'];
            $author = $this->authorDAO->find($authorId);
            $book->setAuthor($author);
        }
        
        return $book;
    }
}