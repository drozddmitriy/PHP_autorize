<?php

require_once __DIR__. '/lib/auth.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $success = authorize($username, $password);
    if ($success) {
        header('Location: /index.html');
        exit;
    }
}
header('Location: /login.html');
exit;