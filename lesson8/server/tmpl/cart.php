<div class="cart-product">
    <img src="<?=$imgPath_product?>" alt="<?$name_product?>" class="cart-img">
    <div class="desc">
        <h3><?=$name_product?></h3>
        <p>Цена: <?= $quantity*$price_product?></p>
        <p>К-во: <?= $quantity?></p>
        <a class="buy-btn" href="?p=cart&f=del&id=<?=$id_product?>">Удалить</a>
    </div>
</div>
