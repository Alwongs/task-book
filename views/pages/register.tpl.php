<main class="page">
    <h1>Регистрация</h1>
    <form class="form auth-form" method="POST">

        <?php if(!empty($pageData['error'])) : ?>
            <p class="form-notification"> 
                <?= $pageData['error'] ?> 
            </p>
        <?php endif; ?>

        <div class="form__input-group">
            <div class="input-block">
                <label for="login">Логин:</label>
                <input id="login" type="text" name="login" required>
            </div>

            <div class="input-block">
                <label for="fullName">Имя:</label>
                <input id="fullName" type="text" name="full_name" required>
            </div>

            <div class="input-block">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required>
            </div>

            <div class="input-block">
                <label for="password">Пароль:</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="input-block">
                <label for="passwordConfirm">Подтверждение:</label>
                <input id="passwordConfirm" type="password" name="password_confirm" required>
            </div>
        </div>

        <div class="form-btn-block">
            <a href="/user/login">Уже есть аккаунт?</a>
            <button type="submit" class="btn btn-green">Сохранить</button>
        </div>
    </form>
</main>

