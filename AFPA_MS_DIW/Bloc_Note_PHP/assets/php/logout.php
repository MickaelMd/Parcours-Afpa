<?php

session_start();
unset($_SESSION['login']);
unset($_SESSION['id']);

if (isset($_COOKIE['login'])) {
    setcookie('login', '', time() - 3600, '/', '', true, true);
}

if (ini_get('session.use_cookies')) {
    setcookie(session_name(), '', time() - 42000, '/');
}

session_destroy();
header('Location: '.$_SERVER['HTTP_REFERER']);