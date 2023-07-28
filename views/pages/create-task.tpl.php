<main>
    <h1>Новая задача</h1>
    <form class="form task-form" action="/task/store" method="POST">

        <?php if(!empty($pageData['error'])) : ?>
            <p class="form-notification"> 
                <?= $pageData['error'] ?> 
            </p>
        <?php endif; ?>

        <div class="form__input-group">
            <div class="input-block">
                <label for="task-edit-input">Имя:</label>
                <input type="text" name="full_name" required>
            </div>

            <div class="input-block">
                <label for="task-edit-input">Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-block">
                <label for="task-edit-input">Текст задачи:</label>
                <input type="text" name="task" required>
            </div>
        </div>

        <div class="form-btn-block">
            <button type="submit" class="btn btn-green">Сохранить</button>
        </div>
    </form>
</main>
