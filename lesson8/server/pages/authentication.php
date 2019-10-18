<?php
function index() {
    return render('auth');
}
function authentication() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        logIn($_POST);
    }
    header('Location: /?p=authentication');
    exit;
}

function logOut() {
    $_SESSION = [];
    session_destroy();
    setcookie('user_login', $_COOKIE['user_login'], time() - 3600);
    setcookie('user_password', $_COOKIE['user_password'], time() - 3600);
    header('Location: /?p=authentication');
    exit;
}