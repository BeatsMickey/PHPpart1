<form method="post" action="?p=registration&f=addUser" class="reg_form">
    <label class="reg_elem"> Логин:<sup>*</sup>
        <input type="text" name="user_login" placeholder="Login" required>
    </label>
    <label class="reg_elem"> Пароль:<sup>*</sup>
        <input type="text" name="user_password" placeholder="Password" required>
    </label>
    <label class="reg_elem"> Имя:
        <input type="text" name="user_name" placeholder="Иван">
    </label>
    <label class="reg_elem"> Возвраст:
        <input type="number" name="user_age" placeholder="18">
    </label>
    <p class="reg_elem">* - поля обязательные для заполнения</p>
    <button type="submit" class="buy-btn reg_button">Зарегестрироваться</button>
</form>
