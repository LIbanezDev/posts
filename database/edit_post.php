<?php
require_once 'connection.php';
if (isset($_SESSION['user_data']) && isset($_POST)) {
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];
    $new_category = $_POST['category'];
    $post_id = $_SESSION['post_info']['id'];
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check){
        $target_dir = "uploads/";
        $file_name = $_SESSION['user_data']['id'] . '_' . $new_category . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Delete actual image
            unlink($target_dir.$_SESSION['post_info']['image']) or die("Couldn't delete file");
        }
    }else $file_name = $_SESSION['post_info']['image'];

    $edit_post_query = /** @lang text */
                "UPDATE posts SET title = '$new_title', content = '$new_content',
        category_id = $new_category, image = '$file_name' WHERE id = $post_id";
    $result = $conn->query($edit_post_query);
    if ($result) header('Location:/post.php?id=' . $post_id);
}
