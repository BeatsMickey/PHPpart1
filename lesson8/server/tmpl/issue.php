<form method="post" action="?p=issue&f=confirm" class="reg_form">
    <label class="reg_elem"> Введите ваше имя:<sup>*</sup>
        <input type="text" name="order_name" placeholder="Ваше имя" value="<?=$user_name?>" required>
    </label>
    <label class="reg_elem">Введите ваш телефон:<sup>*</sup>
        <input type="text" name="order_phone" placeholder="Ваш телефон" required>
    </label>
    <label class="reg_elem">Введите ваш адрес:<sup>*</sup>
        <input type="text" name="order_adress" placeholder="Ваш адрес" required>
    </label>
    <label class="reg_elem">Введите ваш e-mail:
        <input type="email" name="order_mail" placeholder="Ваш e-mail">
    </label>
    <label class="reg_elem">Комментарий к заказу:<br>
        <textarea name="order_coment" cols="80" rows="10" placeholder="Ваш комментарий(255 символов максимальная длинна)" class="textarea" maxlength="255"></textarea>
    </label>
    <p class="reg_elem">Окончательная цена: <?=$price?>руб.</p>
    <button type="submit" class="buy-btn reg_button">Подтвердить</button>
</form>
