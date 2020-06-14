<?php
    require_once 'components/header.php';
    require_once 'components/aside.php';
    require_once 'components/helpers.php';
    if(!isset($_SESSION['user_data']) && !isset($_GET['profile_id'])) header('Location:/');
    if (isset($_SESSION['user_data']) && isset($_GET['profile_id']) && $_SESSION['user_data']['id'] === $_GET['profile_id']) header('Location:/profile.php');
    if (isset($_GET['profile_id'])) $user_data = getUserProfile($conn, $_GET['profile_id'])->fetch_assoc();
    else $user_data = $_SESSION['user_data'];
?>
<div id="principal">
<!--    Profile -->
    <div class="bloqueform">
        <?php if(isset($_SESSION['user_data']) && !isset($_GET['profile_id'])): ?>
        <h1> My Profile </h1>
        <form method="post" action="database/edit_user.php">
            <label>
                <input type="text" value="<?=$user_data['name']?>" name="name">
            </label>
            <label>
                <input type="email" value="<?=$user_data['email']?>" name="email">
            </label>
            <label>
                <input type="number" value="<?=$user_data['age']?>" name="age">
            </label>
            <h6>Registered since: <?= $user_data['date'] ?></h6>
            <h6>Posts: <?= $user_data['posts'] ?></h6>
            <hr>
            <input type="submit" value="Edit info">
        </form>
        <?php else: ?>
        <h1> <?=  strtoupper($user_data['name']) ?></h1>
        <h5>Email: <?= $user_data['email'] ?></h5>
        <h5>Age: <?= $user_data['age'] ?></h5>
        <h5>Registered since: <?= $user_data['date'] ?></h5>
        <h5>Posts: <?= $user_data['posts'] ?></h5>
        <?php endif; ?>
    </div>
    <?php $posts = getPostsByUserId($conn, $user_data['id']); ?>
    <?php if(!empty($posts)): ?>
        <div class="bloqueform">
            <h1> Posts </h1>
            <ol id="post-list">
                <?php while($post = $posts->fetch_assoc()): ?>
                <li class="element-list"> <?= $post['title'] ?>
                    <a href="post.php?id=<?=$post['id']?>" class="crud-post">
                        <img src="assets/img/arrow.svg" height="15" alt="back"/>
                    </a>
                    <?php if(isset($user_data) && !isset($_GET['profile_id'])): ?>
                        <a href="/database/delete_post.php?id=<?=$post['id']?>" class="crud-post">
                            <img src="assets/img/delete.svg" height="15"alt="delete"> </a>
                        <a href="/edit_post.php?post_id=<?=$post['id']?>" class="crud-post">
                            <img src="assets/img/edit.svg" height="15" alt="edit">
                        </a>
                    <?php endif ?>
                </li>
                <?php endwhile; ?>
            </ol>
            <?= isset($_SESSION['delete']) ? showError($_SESSION['delete'], 'delete') : '' ?>
        </div>
    <?php endif; ?>


<!--    Publish post -->
    <?php if(isset($_SESSION['user_data']) && $_SESSION['user_data'] == $user_data): ?>
    <div class="bloqueform">
        <h1> Publish post </h1>
        <form action="/database/create_post.php" method="post" enctype="multipart/form-data">
            <label>
                Title <input type="text" name="title" minlength="10" maxlength="100">
            </label>
            Content
            <label>
                 <textarea name="content" minlength="20" placeholder="Insert your post content"></textarea>
            </label>
            Section
            <label>
                <?php $categories = getCategories($conn); ?>
                <select name="category">
                    <?php while($category = $categories->fetch_assoc()): ?>
                        <option value="<?=$category['id']?>"><?= $category['name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </label>
            Post Image
            <label>
                <input type="file" name="post_img">
            </label>
            <?php if(!isset($_SESSION['file_upload'])): ?>
                <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'format_error') : '' ?>
                <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'file_exists') : '' ?>
                <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'size_error') : '' ?>
                <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'not_image') : '' ?>
                <?php
                    cleanErrors();
                    else:
                        ?>
                    <div class="alerta alerta-exito">
                        <?= $_SESSION['file_upload']; ?>
                    </div>
                <?php cleanErrors(); endif; ?>
            <hr>
            <input type="submit" value="Publish">
        </form>
    </div>

<!--    Create category -->
    <div class="bloqueform">
        <h1> Create category </h1>
        <form action="/database/create_category.php" method="post">
            Category Name
            <label>
                <input type="text" name="name" minlength="3">
            </label>
            <hr>
            <input type="submit" value="Create">
        </form>
    </div>
    <?php endif; ?>
</div>
<?php require_once 'components/footer.php' ?>

