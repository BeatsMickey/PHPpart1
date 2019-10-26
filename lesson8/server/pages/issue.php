<?php
function index() {
    $html = '<div><p>Заполните дополнительные данные для оформления заказа:</p>';
    if (!empty($_SESSION['variables'][USER_ID])) {
        $row = operationSql("SELECT", " * FROM users WHERE user_id = {$_SESSION['variables'][USER_ID]}")[0];
    }
    $row['price'] = $_SESSION['variables']['price'];
    $html .= render('issue', $row);
    $html .= '</div>';
    return $html;
}

function confirm() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $key = '';
        $val = '';
        foreach ($_POST as $item => $value) {
            if (!empty($value)) {
                $key .= $item . ',';
                $val .= '"' . clrString($value) . '"' . ',';
            }
        }
        if (!empty($_SESSION['variables'][USER_ID])) {
            $key .= 'order_user_id,';
            $val .= '"' . $_SESSION['variables'][USER_ID] . '"' . ',';
        }
        $key .= 'order_products';
        $val .= "'" . json_encode($_SESSION['cart']) . "'";
        operationSql('INSERT INTO', ' orders ' . '(' . $key . ')' . ' VALUES ' . '(' . $val . ')');
        if ($id = mysqli_insert_id(connect())) {
            $_SESSION['variables'][MSG] = 'Номера вашего заказа - ' . $id . '. Заказ успешно отправлен на обработку, узнать статус заказа можно в личном кабинете или по номеру заказа';
            $_SESSION['cart'] = [];
            $_SESSION['variables']['quantity'] = [];
            $_SESSION['variables']['price'] = [];
            header('Location: /');
            exit;
        }
        $_SESSION['variables'][MSG] = 'Заказ не создан, повторите попытку позже';
        header('Location: /?p=cart');
        exit;
    }
    header('Location: /?p=issue');
    exit;
}
