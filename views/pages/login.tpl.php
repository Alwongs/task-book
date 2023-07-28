<main>

    <h1>Вход</h1>
    <form class="form auth-form" method="POST">

        <?php if(!empty($pageData['error'])) : ?>
            <p class="form-notification"><?= $pageData['error'] ?></p>
        <?php endif; ?>

        <div class="form__input-group">
            <div class="input-block">
                <label for="login">Логин:</label>
                <input id="login" type="text" name="login" required>
            </div>

            <div class="input-block">
                <label for="password">Пароль:</label>
                <input id="password" type="password" name="password" required>
            </div>
        </div>

        <div class="form-btn-block flex-center">
            <button type="submit" class="btn btn-green">Войти</button>
        </div>
    </form>
    
</main>

