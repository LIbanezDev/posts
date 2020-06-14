<?php
    session_start();
    require_once 'connection.php';
    if(isset($_GET) && isset($_SESSION['user_data'])){
        $post_id = $_GET['id'];
        $user_id = $_SESSION['user_data']['id'];
        $delete_post_query = /** @lang text */ "DELETE FROM posts WHERE id = $post_id AND user_id = $user_id";
        $delete = $conn->query($delete_post_query);
        if($delete){
            $_SESSION['delete'] = 'Your post has been removed successfully';
            header('Location:/profile.php');
        }else{
            $_SESSION['delete'] = 'An error occurred';
            header('Location:/profile.php');
        }
    }
