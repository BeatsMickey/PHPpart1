<?php
if ((!empty($_POST['one']) || (string)$_POST['one'] === '0') && (!empty($_POST['two']) || (string)$_POST['two'] === '0')) {
    $msg = calc1($_POST['one'], $_POST['two'], $_POST['operation']);
    header('Location: /?p=5&msg=' . $msg);
    exit;
}

$html = render('calc1');