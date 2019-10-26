<?php
function index() {
    isAdmin();
    $row = operationSql('SELECT', ' * FROM products');
    $html = '<form method="post" action="?p=admin_products&f=addProduct" class="reg_form">
                <label class="reg_elem"> Имя продукта:<sup>*</sup>
                    <input type="text" name="name_product" required>
                </label>
                <label class="reg_elem"> Путь до изображения:<sup>*</sup>
                    <input type="text" name="imgPath_product" required>
                </label>
                <label class="reg_elem"> Цена:<sup>*</sup>
                    <input type="text" name="price_product" required>
                </label>
                <p class="reg_elem">* - поля обязательные для заполнения</p>
                <button type="submit" class="buy-btn reg_button">Добавить</button>
            </form><br><div class="products">';
    if (empty($row[0])) {
        $html .= '<p>Ошибка базы данных</p>';
    } else {
        foreach ($row as $value) {
            $html .= render('admin_products', $value);
        }
    }
    $html .= "</div>";
    return $html;
}

function addProduct() {
    isAdmin();
    if (!empty($_POST)) {
        $key = '';
        $val = '';
        foreach ($_POST as $item => $value) {
            if (!empty($value)) {
                $key .=$item . ',';
                $val .= '"' . clrString($value) . '"' . ',';
            }
        }
        $key = substr($key, 0, -1);
        $val = substr($val, 0, -1);
        operationSql('INSERT INTO', ' products ' . '(' . $key . ')' . ' VALUES ' . '(' . $val . ')');
    }
    header('Location: /');
    exit;
}

function changeProductPage() {
    isAdmin();
    $id = getId();
    $row = operationSql("SELECT", " * FROM products WHERE id_product = $id")[0];
    $html = render('changeProduct', $row);
    return $html;
}

function changeProduct() {
    isAdmin();
    if (!empty($_POST)) {
        $id = getId();
        $req = '';
        foreach ($_POST as $item => $value) {
            if (!empty($value)) {
                $req .= $item . ' = ' . '"' . $value . '",';
            }
        }
        $req = substr($req, 0, -1);
        $_SESSION['variables'][MSG] = $req;
        operationSql('UPDATE', ' products SET ' . $req . " WHERE id_product = $id");
    }
    header('Location: /');
    exit;
}

function delProduct() {
    isAdmin();
    $id = getId();
    operationSql('DELETE FROM', " products WHERE id_product = $id");
    header('Location: /');
    exit;
}
