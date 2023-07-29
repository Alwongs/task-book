<main>

    <h1 class="mb-30">
        <?= $pageData['task']['full_name'] ?><br>
        <span>( <?= $pageData['task']['email'] ?> )</span>
    </h1>

    <form class="form task-form" action="/task/update?id=<?= $pageData['task']['id'] ?>" method="POST">

        <?php if(!empty($pageData['error'])) : ?>
            <p class="form-notification"> 
                <?= $pageData['error'] ?> 
            </p>
        <?php endif; ?>

        <div class="form__input-group">
            <div class="input-block">
                <label for="task-edit-input">Текст задачи:</label>
                <input id="task-edit-input" type="text" name="task" placeholder="текст задачи" value="<?= $pageData['task']['task'] ?>" required>
            </div>
            <div class="input-checkbox-block">
                <label for="checkbox">Выполнено:</label>
                <div class="fake-checkbox">
                    <input id="checkbox" type="checkbox" name="status" <?php if($pageData['task']['status']) : ?> checked <?php endif; ?>>
                </div>

            </div>
        </div>

        <div class="form-btn-block">
            <button type="submit" class="btn btn-green">Обновить</button>
        </div>
    </form>

</main>
