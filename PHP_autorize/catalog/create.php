<?php

session_start();

require_once __DIR__ . '/lib/catalog.php';
require_once __DIR__ . '/lib/auth.php';

if (isAuthorized()) {
if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['isbn'])) {

        $book = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'isbn' => $_POST['isbn']
        ];

        createBook($book);
        header('Location: /index.html');
		exit;


} else {
    header('Location: /login.html');
	exit;
}
}