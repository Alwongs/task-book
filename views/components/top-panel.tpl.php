<header class="top-panel">
    <div class="top-panel__logo">
        <a href="/">Задачник</a>
    </div>

    <nav class="top-panel__nav">
        <?php if(isset($_SESSION['auth'])) : ?>
            <a href="/user/profile"><?= $_SESSION['auth']['full_name'] ?></a>            
            <a href="/user/logout" class="icon-logout"></a>
        <?php else: ?>
            <a href="/user/login">Войти</a>
        <?php endif; ?>  
    </nav>
</header>