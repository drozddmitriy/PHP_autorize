<?php

define('CATALOG_FILE', __DIR__ . '/../data/catalog.json');

/**
 * Create book.
 *
 * @param array $book
 */
function createBook(array $book)
{
    $books = readCatalog();
    foreach ($books as $item) {
        if ($item['title'] == $book['title']) {
            return false;
        }
    }

    array_push($books, $book);

    saveCatalog($books);
    return true;
}

/**
 * Delete book by title.
 *
 * @param string $title
 */
function deleteBook($title)
{
    $books = readCatalog();
    foreach ($books as $key =>$item) {
        if ($item['title'] == $title) {
            unset($books[$key]);
        }
    }
	
    saveCatalog($books);
}
/**
 * Read catalog file.
 *
 * @return array
 */
function readCatalog()
{
    $booksJson = file_get_contents(CATALOG_FILE);
    $books = json_decode($booksJson, true);
    if (empty($books)) {
        return [];
    }
    return $books;
}

/**
 * Save catalog file.
 *
 * @param array $books
 */
function saveCatalog(array $books)
{
    $booksJson = json_encode($books);
    file_put_contents(CATALOG_FILE, $booksJson);
}