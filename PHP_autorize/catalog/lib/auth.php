<?php

define('USER_STORAGE', __DIR__ . '/../data/users.json');

/**
 * Authorize user.
 *
 * @param string $username
 * @param string $password
 *
 * @return bool
 */
function authorize($username, $password)
{
    $users = readUsers();

    foreach ($users as $user) {
        if ($user['username'] == $username) {
            if ($user['password'] == md5($password)) {
                session_start();
                $_SESSION['user'] = serialize($user);
                return true;
            }
        }
    }
    return false;
}

/**
 * Check user is authorized.
 *
 * @return bool
 */
function isAuthorized()
{
    return (isset($_SESSION['user']))? true : false;
}

/**
 * Create new user.
 *
 * @param string $username
 * @param string $password
 * @return bool
 */
function register($username, $password)
{
    $users = readUsers();
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            return false;
        }
    }

    $newUser = [
      'username' => $username,
      'password' => md5($password)
    ];

    $newUser = array_merge($users, $newUser);

    saveUsers($newUser);
    return true;
}

/**
 * Load users.
 *
 * @return array
 */
function readUsers()
{
    $userJson = file_get_contents(USER_STORAGE);
    $users = json_decode($userJson, true);
    if (empty($users)) {
        return [];
    }
    return $users;
}

/**
 * Save users.
 *
 * @param array $users
 */
function saveUsers(array $users)
{
    $userJson = json_encode([$users]);
    file_put_contents(USER_STORAGE, $userJson);
}
