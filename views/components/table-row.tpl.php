<div class="row">
    <div class="column col-1">
        <?= $task['full_name'] ?>
    </div>

    <div class="column col-2">
        <?= $task['email'] ?>
    </div>

    <div class="column col-3">
        <?= $task['task'] ?>
    </div>

    <div class="column <?= isset($_SESSION['auth']) && $_SESSION['auth']['is_admin'] ? 'col-4' : 'col-4-5' ?>">
        <span class="<?= $task['status'] == 1 ? 'task-is-done' : '' ?>">
            <?= $task['status'] == 1 ? 'выполнено' : 'ожидание' ?>
        </span>
    </div>

    <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['is_admin']) : ?>                    
        <div class="column col-5">
            <a href="/task/edit?id=<?= $task['id'] ?>" class="edit-icon"></a>
        </div>
    <?php endif; ?>  
</div>