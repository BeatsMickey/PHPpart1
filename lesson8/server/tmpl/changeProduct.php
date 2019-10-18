<form method="post" action="?p=admin_products&f=changeProduct&id=<?=$id_product?>" class="reg_form">
    <label class="reg_elem"> Имя продукта:<sup>*</sup>
        <input type="text" name="name_product" value="<?=$name_product?>">
    </label>
    <label class="reg_elem"> Путь до изображения:<sup>*</sup>
        <input type="text" name="imgPath_product" value="<?=$imgPath_product?>">
    </label>
    <label class="reg_elem"> Цена:<sup>*</sup>
        <input type="text" name="price_product" value="<?=$price_product?>">
    </label>
    <button type="submit" class="buy-btn reg_button">Изменить</button>
</form><br><div class="products">
