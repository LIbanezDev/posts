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
    <div class="bloqueform">
        <?php if(isset($_SESSION['user_data']) && isset($_GET['post_id'])): ?>
        <?php $post_data = getPost($conn, $_GET['post_id'])->fetch_assoc()?>
        <?php $_SESSION['post_info'] = $post_data;?>
        <h1> Edit post </h1>
        <form method="post" action="database/edit_post.php" enctype="multipart/form-data">
            <label>
                <input type="text" value="<?=$post_data['title']?>" name="title">
            </label>
            <label style="height: fit-content">
                <textarea name="content"><?=$post_data['content'] ?></textarea>
            </label>
            <label>
                <?php $categories = getCategories($conn); ?>
                <select name="category">
                    <?php while($category = $categories->fetch_assoc()): ?>
                        <option value="<?=$category['id']?>" <?php if($category['id'] ===
                        $post_data['category_id']) echo 'selected'; ?>> <?= $category['name'] ?> </option>
                    <?php endwhile; ?>
                </select>
            </label>
            <img src="database/uploads/<?=$post_data['image']?>" height="150" width="150" alt="post_img">
            <label>
                <input type="file" name="image">
            </label>
            <hr>
            <input type="submit" value="Save and exit">
        </form>
        <?php else: ?>
        <?php header('Location:/');?>
        <?php endif; ?>
    </div>
</div>
<?php require_once 'components/footer.php' ?>
