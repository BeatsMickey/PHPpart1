<?php

function index() {
    isAdmin();
    $html = '<div class="private">';
    $row = operationSql('SELECT', ' order_id FROM orders WHERE order_status = "processing"');
    if (empty($row[0])) {
        $html .= '<p>Нету заказов на подтверждение.</p>';
    } else {
        foreach ($row as $value) {
            $html .= render('admin_office', $value);
        }
    }
    $html .= '</div>';
    return $html;
}

function orderDetails() {
    isAdmin();
    if (!empty($_GET['id'])) {
        $id = getId();
    } else {
        header('Location: /?p=private_office');
        exit;
    }
    $row = operationSql("SELECT", " * FROM orders WHERE order_id = $id");
    if (!empty($row)) {
        $status = $row[0]['order_status'];
        $products = json_decode($row[0]['order_products'], true);
        $phone = $row[0]['order_mail'];
        $adress = $row[0]['order_adress'];
        $name = $row[0]['order_name'];
        $mail = empty($row[0]['order_mail']) ? 'Отсутствует' : $row[0]['order_mail'];
        $coment = empty($row[0]['order_coment']) ? 'Отсутствует' : $row[0]['order_coment'];
    } else {
        $_SESSION['variables'][MSG] = "Заказ не найден или не доступна база данных.";
        header('Location: /?p=private_office');
        exit;
    }
    $price = 0;
    $html = '<div class="products cart">';
    foreach ($products as $value) {
        $html .= render('orderDetails', $value);
        $price += $value['price_product'] * $value['quantity'];
    }
    $html .= "<br><p>Общая цена: {$price}руб.</p><br><p>Адрес: {$adress}</p>
    <br><p>E-mail: {$mail}</p><br><p>Комментарий: {$coment}</p><br><p>Статус заказа: {$status}</p><br>
    <a class='buy-btn issue-btn' href='?p=admin_office&f=confirm&id={$id}'>Подтвердить</a><br><a class='buy-btn issue-btn' href='?p=admin_office'>Назад</a></div>";
    return $html;
}

function confirm() {
    isAdmin();
    if (!empty($_GET['id'])) {
        $id = getId();
    } else {
        header('Location: /?p=private_office');
        exit;
    }
    operationSql("UPDATE", " orders SET order_status = 'confirmed' WHERE order_id = $id");
    header('Location: /?p=admin_office');
    exit;
}
