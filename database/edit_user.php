<?php
    session_start();
    require_once 'connection.php';
    if(isset($_SESSION['user_data']) && isset($_POST)){
        $new_name = $_POST['name'];
        $new_email = $_POST['email'];
        $new_age = $_POST['age'];
        $user_id = $_SESSION['user_data']['id'];
        $edit_user_query = /** @lang text */ "UPDATE users SET name = '$new_name', email = '$new_email',
        age = $new_age WHERE id = $user_id";
        $conn->query($edit_user_query);
        header('Location:/profile.php');
    }