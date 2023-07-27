<main class="page profile-page">

    <h1><?= $_SESSION['auth']['full_name'] ?></h1>

    <p><span>Email:</span><?= $_SESSION['auth']['email'] ?></p>
    <p><span>Is Admin:</span><?= $_SESSION['auth']['is_admin'] ? 'Да' : 'Нет' ?></p>

</main>
