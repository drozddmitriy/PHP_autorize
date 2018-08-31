<?php

session_start();

require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/lib/catalog.php';


if (isAuthorized()) {
	if(!empty($_GET['title'])){
		deleteBook($_GET['title']);
	}
	else {
		header('Location: /login.html');
		exit;
	}
	header('Location: /index.html');
	exit;
}

