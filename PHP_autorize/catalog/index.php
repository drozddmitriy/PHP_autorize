<?php

session_start();

require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ .'/lib/catalog.php';

if (isAuthorized()) {
$books = readCatalog();
} else {
    header('Location: /login.html');
	exit;
}
