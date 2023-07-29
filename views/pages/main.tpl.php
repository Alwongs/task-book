<?php 
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 
    $sortDirect = isset($_GET['sortDirect']) ? $_GET['sortDirect'] : 'DESC'; 

    $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'created_at';
    $orderByName = $orderBy == 'full_name' ? 'is-sorted': '';
    $orderByEmail = $orderBy == 'email' ? 'is-sorted': '';
    $orderByStatus = $orderBy == 'status' ? 'is-sorted': '';
?>

<main>

    <h1>Задачи</h1>

    <div class="btn-block mb-16 flex-between">

        <?php if(isset($pageData['tasksOnPage'])) : ?>        
            <div class="sort-block">
                <label for="sort-by-select">Сортировать по: </label>
                <select id="sort-by-select"  class="select-sort-by">
                    <option
                        onclick="location.href = '/task?orderby=created_at&sortDirect=DESC&page=<?= $page ?>'" 
                        <?= $orderBy == 'created_At' ? 'selected': ''; ?>                    
                    > ---- </option>

                    <option 
                        onclick="location.href = '/task?orderby=full_name&sortDirect=<?= $sortDirect ?>&page=<?= $page ?>'" 
                        <?= $orderBy == 'full_name' ? 'selected': ''; ?>
                    > имени </option>

                    <option 
                        onclick="location.href = '/task?orderby=email&sortDirect=<?= $sortDirect ?>&page=<?= $page ?>'" 
                        <?= $orderBy == 'email' ? 'selected': ''; ?>
                    > email </option>

                    <option 
                        onclick="location.href = '/task?orderby=status&sortDirect=<?= $sortDirect ?>&page=<?= $page ?>'"
                        <?= $orderBy == 'status' ? 'selected': ''; ?>
                    > cтатусу </option>
                </select>

                <!-- <label for="sort-direct">по: </label> -->
                <select id="sort-direct" class="select-direct-sort">
                    <!-- <option> ---- </option> -->

                    <option 
                        onclick="location.href = '/task?orderby=<?= $orderBy ? $orderBy : 'created_at' ?>&sortDirect=ASC&page=<?= $page ?>'"
                        <?= $sortDirect == 'ASC' ? 'selected': ''; ?>
                    > по возрастанию </option>

                    <option 
                        onclick="location.href = '/task?orderby=<?= $orderBy ? $orderBy : 'created_at' ?>&sortDirect=DESC&page=<?= $page ?>'"
                        <?= $sortDirect == 'DESC' ? 'selected': ''; ?>
                    > по убыванию </option>

                </select>
            </div>
        <?php endif; ?>

        <a href="/task/create" class="btn btn-blue">
            Добавить задачу
        </a>
    </div>










    <?php if(isset($pageData['tasksOnPage'])) : ?>
        <div class="table">
            <div class="table-header row">

                <div class="column col-1">
                    <span class="sort-link <?= $orderByName ?>"> имя </span>
                </div>

                <div class="column col-2">
                    <span class="sort-link <?= $orderByEmail ?>"> email </span>
                </div>

                <div class="column col-3">
                    задача
                </div>

                <div class="column <?= isset($_SESSION['auth']) && $_SESSION['auth']['is_admin'] ? 'col-4' : 'col-4-5' ?>">
                    <span class="sort-link <?= $orderByStatus ?>"> статус </span>                   
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
    <?php else : ?>
        <p class="table-message">
            <?= $pageData['message'] ?>
        </p>
    <?php endif; ?>        

    <?php if(isset($pageData['pagination'])) : ?>
        <div class="pagination-block">
            <?= $pageData['pagination'] ?>
        </div>
    <?php endif; ?>

</main>