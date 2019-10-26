<?php
function index() {
    $price = 0;
    $html = '<div class="products cart">';
    if (empty($_SESSION[CART])) {
        $html .= '<p>Корзина пуста</p>';
    } else {
        foreach ($_SESSION[CART] as $value) {
            $html .= render(CART, $value);

            $price += $value['price_product'] * $value['quantity'];
        }
        $_SESSION['variables']['price'] = $price;
        $html .= "<br><p>Общая цена: {$price}руб.</p><br><a class='buy-btn issue-btn' href='?p=issue'>Оформить</a>";
    }
    $html .= "</div>";
    return $html;
}

function del() {
    $id = getId();
    if (array_key_exists($id, $_SESSION[CART])) {
        if ($_SESSION[CART][$id]['quantity'] == 1) {
            unset($_SESSION[CART][$id]);
            $_SESSION['variables']['quantity'] -= 1;
        } else {
            $_SESSION[CART][$id]['quantity'] -= 1;
            $_SESSION['variables']['quantity'] -= 1;
        }
        header('Location: /?p=cart');
        exit;
    } else {
        header('Location: /?p=cart');
        exit;
    }
}