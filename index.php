<?php
    require_once 'components/header.php';
    require_once 'components/aside.php';
    require_once 'components/helpers.php';
?>
<div id="principal">
    <?php
        if(isset($_GET['category'])){
            $posts = getPostsByCategory($conn, $_GET['category']);
            echo '<h1>'. getCategory($conn, $_GET['category'])->fetch_assoc()['name'].'</h1>';
        }else if(isset($_GET['search'])){
            $posts = getPostsBySearch($conn, $_GET['search']);
            echo '<h1> Results for: '. $_GET['search'] .'</h1>';
        }else{
            $posts = getPosts($conn);
            echo '<h1> Latest Posts </h1>';
        }
    ?>
    <?php while($post = $posts->fetch_assoc()): ?>
        <article class="entrada">
            <a href="post.php?id=<?=$post['id']?>"> <h2> <?= $post['title'] ?> </h2> </a>
            <span class="fecha">
                Uploaded by <a style="color: #007ee5" href="profile.php?profile_id=<?=$post['user_id']?>"><?=$post['user']?>
                </a> on <?=$post['date'] ?> | Category: <a style="color: #007ee5" href="index.php?category=<?=$post['category_id']?>">
                <?=$post['category']?> </a>
            </span>
            <p> <?= substr($post['content'],0,180).'...'; ?> </p>
        </article>
    <?php  endwhile; ?>
    <hr>
    <?php if(isset($_GET['category']) || isset($_GET['search'])): ?>
        <a href="/"> <img src="assets/img/back.svg" height="20" title="back" alt="back"/> </a>
    <?php endif; ?>
</div>
<?php require_once 'components/footer.php' ?>





