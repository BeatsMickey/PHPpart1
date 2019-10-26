<?php
function index() {
    if (!empty($_SESSION['variables'][USER_ID])) {
        $html = '<div class="private">';
        $row = operationSql('SELECT', ' order_id FROM orders WHERE order_user_id = ' . $_SESSION['variables'][USER_ID]);
        if (empty($row[0])) {
            $html .= '<p>У вас нету заказов</p>';
        } else {
            foreach ($row as $value) {
                $html .= render('private_office', $value);
            }
        }
        $html .= '</div>';
        return $html;
    }
    return '
    <form method="post" action="?p=private_office&f=orderDetails" class="reg_form"> 
        <label class="reg_elem"> Введите номер вашего заказа:<sup>*</sup>
            <input type="text" name="id" placeholder="Номер заказа" required>
        </label>
        <button type="submit" class="buy-btn reg_button">Проверить</button>
    </form>
    ';
}

function orderDetails() {
    if (!empty($_GET['id'])) {
        $id = getId();
    } elseif (!empty($_POST['id'])) {
        $id = clrString($_POST['id']);
    } else {
        header('Location: /?p=private_office');
        exit;
    }
    $row = operationSql("SELECT", " order_status,order_products FROM orders WHERE order_id = $id");

    if (!empty($row)) {
        $status = $row[0]['order_status'];
        $products = json_decode($row[0]['order_products'], true);
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
    $html .= "<br><p>Общая цена: {$price}руб.</p><br><p>Статус вашего заказа: {$status}</p><br><a class='buy-btn issue-btn' href='?p=private_office'>Назад</a></div>";
    return $html;
}
