<form method="post" action="?p=authentication&f=authentication" class="reg_form">
    <label class="reg_elem"> Введите ваш логин:
        <input type="text" name="user_login" placeholder="Login" required>
    </label>
    <label class="reg_elem">Введите ваш пароль:
        <input type="text" name="user_password" placeholder="Password" required>
    </label>
    <label class="reg_elem reg_login">
        <input type="checkbox" name="insystem"> - оставаться в системе
    </label>
    <a href="?p=registration" class="auth_buttonToReg">Регистрация</a>
    <button type="submit" class="buy-btn reg_button">Войти</button>
</form>