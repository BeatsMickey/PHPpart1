<?php

function index() {
    if ($_SESSION['variables'][IS_ADMIN] == true) {
        header('Location: /?p=admin_products');
        exit;
    }

    $row = operationSql('SELECT', ' * FROM products');
    $html = '<div class="products">';
    if (empty($row[0])) {
        $html .= '<p>Ошибка базы данных</p>';
    } else {
        foreach ($row as $value) {
            $html .= render('products', $value);
        }
    }
    $html .= '</div>';
    return $html;
}

function addToCart() {
    $id = getId();
    $row = operationSql('SELECT', '* FROM products WHERE id_product = ' . $id);
    $row = $row[0];
    if (empty($row)) {
        header('Location: /');
        exit;
    }
    if (array_key_exists($id, $_SESSION[CART])) {
        $_SESSION[CART][$id]['quantity'] += 1;
    } else {
        $row['quantity'] = 1;
        $_SESSION[CART][$id] = $row;
    }
    $_SESSION['variables']['quantity'] += 1;
    header('Location: /');
    exit;
}