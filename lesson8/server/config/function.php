<?php
function render($tmpl, $params = [])
{
    extract($params);
    ob_start();
    include dirname(__DIR__) . '/tmpl/' . $tmpl . '.php';
    return ob_get_clean();
}

function isAdmin()
{
    if (empty($_SESSION['variables'][IS_ADMIN])) {
        $_SESSION['variables'][MSG] = 'Нет прав';
        header('Location: /');
        exit;
    }
}

function clrString($str) {
    return mysqli_real_escape_string(connect(), strip_tags(trim($str)));
}

function getId() {
    return !empty($_GET['id']) ? clrString($_GET['id']) : 0;
}

function operationSql(string $operation, string $req) {
    $link = connect();
    if ($operation === 'SELECT') {
        $res = mysqli_query($link, $operation . $req);
        $arr = [];
        while($row = mysqli_fetch_assoc($res)) {
            $arr[] = $row;
        }
        return $arr;
    } else {
        $res = mysqli_query($link, $operation . $req);
        mysqli_fetch_assoc($res);
    }
}

function logIn(array $Arr) {
    $login = clrString($Arr['user_login']);
    $row = operationSql("SELECT", " * FROM users WHERE user_login = '{$login}'");
    $row = $row[0];
    if (!empty($row) && password_verify($Arr['user_password'], $row['user_password'])) {
        $_SESSION['variables'][MSG] = 'Пароль принят';
        $_SESSION['variables'][USER_ID] = (int)$row['user_id'];
        $_SESSION['variables'][IS_ADMIN] = (bool)$row['is_admin'];
        if ($Arr['insystem'] == true) {
            setcookie('user_login', $login, time() + 3600 * 24 * 7);
            setcookie('user_password', $Arr['user_password'], time() + 3600 * 24 * 7);
        }
        header('Location: /');
        exit;
    }
    $_SESSION['variables'][MSG] = 'Не верный логин или пароль';
    header('Location: /?p=authentication');
    exit;
}

function checkLogIn() {
    if (empty($_SESSION['variables'][USER_ID])) {
        if (empty($_COOKIE['user_login']) && empty($_COOKIE['user_password'])) {
            $_SESSION['variables'][TMPL_MENU] = 'LogOut.tmpl';
            return;
        }
        logIn($_COOKIE);
    }
    if ($_SESSION['variables'][IS_ADMIN] == true) {
        $_SESSION['variables'][TMPL_MENU] = 'adminLogIn.tmpl';
        return;
    }
    $_SESSION['variables'][TMPL_MENU] = 'userLogIn.tmpl';
}




