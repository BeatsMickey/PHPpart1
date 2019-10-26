<?php
function index() {
    return render('reg');
}

function addUser() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = clrString($_POST['user_login']);
        $row = operationSql("SELECT", " user_login FROM users WHERE user_login = '{$login}'");
        if (!empty($row)) {
            $_SESSION['variables'][MSG] = 'Пользователь с таким именем уже существует';
            header('Location: /?p=registration');
            exit;
        }
        $key = '';
        $val = '';
        foreach ($_POST as $item => $value) {
            if (!empty($value)) {
                $key .=$item . ',';
                if ($item == 'user_password') {
                    $value = password_hash($value, PASSWORD_BCRYPT, ["cost" => 12]);
                }
                $val .= '"' . clrString($value) . '"' . ',';
            }
        }
        $key = substr($key, 0, -1);
        $val = substr($val, 0, -1);
        operationSql('INSERT INTO', ' users ' . '(' . $key . ')' . ' VALUES ' . '(' . $val . ')');
        if (mysqli_insert_id(connect())) {
            $_SESSION['variables'][MSG] = 'Регистрация успешно пройдена';
            header('Location: /?p=registration');
            exit;
        }
        $_SESSION['variables'][MSG] = 'Регистрация не удалась, повторите попытку позднее.';
        header('Location: /?p=registration');
        exit;
    }
    header('Location: /?p=registration');
    exit;
}
