<?php

require_once __DIR__. '/lib/auth.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $success = register($username, $password);
    if ($success) {
        header('Location: /login.html');
        exit;
    }
    header('Location: /register.html');
    exit;
}