<?php
require_once 'components/header.php';
require_once 'components/aside.php';
require_once 'components/helpers.php';
if (!isset($_GET['id'])) header('Location:/');
?>
    <div id="principal">
        <?php $post = (getPost($conn, $_GET['id'])->fetch_assoc()); ?>
        <article class="entrada">
            <h1 c> <?= $post['title'] ?> </h1>
            <img class="center" src="/database/uploads/<?= $post['image'] ?>" height="200px" alt="image"
                 style="display:
        block; text-align: center;">
            <p> <?= $post['content'] ?> </p>
            <span class="fecha">
                Uploaded by
                <a style="color: #007ee5" href="profile.php?profile_id=<?= $post['user_id'] ?>"><?= $post['user'] ?></a>
                on <?=$post['date'] ?>
                | Category: <a style="color: #007ee5" href="index.php?category=<?=$post['category_id']?>"><?=$post['category']?> </a>
            </span>
            <hr>
            <a href="/"> <img src="assets/img/back.svg" height="20"/> </a>
        </article>
    </div>
<?php require_once 'components/footer.php' ?>