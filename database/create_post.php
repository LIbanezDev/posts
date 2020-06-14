<?php
require_once 'connection.php';
if (isset($_POST) && isset($_SESSION['user_data'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $target_dir = "uploads/";
    $file_name = $_SESSION['user_data']['id'] . '_'.$category.'_' . basename($_FILES["post_img"]["name"]);
    $target_file = $target_dir . $file_name;

    $errors = array();

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["post_img"]["tmp_name"]);
    if (!$check) $errors['not_image'] = 'Your file is not a image.';

    // Check if file already exists
    if (file_exists($target_file)) $errors['file_exists'] = 'File already exists';

    // Check file size
    if ($_FILES["post_img"]["size"] / 1000000 > 1.5 ) $errors['size_error'] = "Image can't exceed 1.5 mb";


    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") $errors['format_error'] = 'Your file is not in a correct format.';


    // Check if $uploadOk is set to 0 by an error
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location:/profile.php');
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["post_img"]["tmp_name"], $target_file)) {
            $user_post = $_SESSION['user_data']['id'];
            $insert_post_query = /** @lang text **/ "INSERT INTO posts VALUES (NULL, $user_post, $category, '$title', '$content', CURDATE(), '$file_name')";
            $result = $conn->query($insert_post_query);
            $user_id = $_SESSION['user_data']['id'];
            $increase_posts_count = /** @lang text */ "UPDATE users SET posts = posts + 1 WHERE id = $user_id";
            $conn->query($increase_posts_count);
            if($result) {
                $_SESSION['file_upload'] = 'Your post has been published!';
                header('Location:/profile.php');
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}