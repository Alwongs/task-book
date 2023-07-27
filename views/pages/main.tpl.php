<?php 
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 
    $sortDirect = isset($_SESSION['boolean']) ? $_SESSION['boolean'] : true; 
    $sortDirect = !$sortDirect ? 'sort-asc' : 'sort-desc';
    $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'created_at';
    $orderByName = $orderBy == 'full_name' ? 'is-sorted': '';
    $orderByEmail = $orderBy == 'email' ? 'is-sorted': '';
    $orderByStatus = $orderBy == 'status' ? 'is-sorted': '';
?>

<main class="page">

    <h1>Задачи</h1>

    <div class="btn-block mb-16 flex-end">
        <a href="/task/create" class="btn btn-blue">Добавить задачу</a>
    </div>

    <div class="table">
        <div class="table-header row">
            <div class="column col-1">
                <a 
                    class="sort-link <?= $sortDirect ?> <?= $orderByName ?>" 
                    href="/task?orderby=full_name&page=<?= $page ?>"
                >
                    имя
                </a>
            </div>

            <div class="column col-2">
                <a 
                    class="sort-link <?= $sortDirect ?> <?= $orderByEmail ?>" 
                    href="/task?orderby=email&page=<?= $page ?>"
                >
                    email
                </a>
            </div>

            <div class="column col-3">
                задача
            </div>

            <div class="column <?= isset($_SESSION['auth']) && $_SESSION['auth']['is_admin'] ? 'col-4' : 'col-4-5' ?>">
                <a 
                    class="sort-link <?= $sortDirect ?> <?= $orderByStatus ?>" 
                    href="/task?orderby=status&page=<?= $page ?>"
                >
                    статус
                </a>                   
            </div>

            <?php if(isset($_SESSION['auth'])) : ?>
                <div class="column col-5">Ред.</div>
            <?php endif; ?>
        </div>

        <div class="table-body">
            <?php foreach($pageData['tasksOnPage'] as $task) : ?>
                <?php require "views/components/table-row.tpl.php"; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="pagination-block">
        <?php echo $pageData['pagination']; ?>
    </div>
</main>