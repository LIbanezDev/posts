<?php
    require_once 'database/connection.php';
    if(isset($_SESSION['user_data'])) {
        $user_id = $_SESSION['user_data']['id'];
        $update_session_query = /** @lang text */"SELECT * FROM users WHERE id = $user_id";
        $_SESSION['user_data'] = $conn->query($update_session_query)->fetch_assoc();
    }

    function getUserProfile($conn, $id){
        $user_query = /** @lang text */ "SELECT id, name, age, email, date, posts FROM users WHERE id = $id;";
        $user = $conn->query($user_query);
        if($user->num_rows == 1) return $user;
        else header('Location:/');
        return 0;
    }
    function showError($errors_array, $input){
        $error_msg = '';
        if(isset($errors_array[$input]) && !empty($input)){
            $error_msg = "<div class='alerta alerta-error'> $errors_array[$input] </div>";
        }
        return $error_msg;
    }
    function cleanErrors(){
        if(isset($_SESSION['errors'])) $_SESSION['errors'] = null;
        if(isset($_SESSION['register'])) $_SESSION['register'] = null;
        if(isset($_SESSION['file_upload'])) $_SESSION['file_upload'] = null;
        if(isset($_SESSION['delete'])) $_SESSION['delete'] = null;
        return '';
    }
    function getCategories($conn){
        $categories_query = /** @lang text */
            "SELECT c.id, c.name, COUNT(p.category_id) AS amount FROM categories c
            LEFT JOIN posts p on c.id = p.category_id
            GROUP BY c.id;";
        $categories = $conn->query($categories_query);
        $categories_return = array();
        if($categories->num_rows >= 1) $categories_return = $categories;
        return $categories_return;
    }
    function getCategory($conn, $id){
        $category_query = /** @lang text */
            "SELECT name FROM categories WHERE id = $id";
        $category = $conn->query($category_query);
        if($category->num_rows == 1) return $category;
        else header('Location:/');
        return 0;
    }
    function getPosts($conn){
        $posts_query = /** @lang text */
            "SELECT c.id AS category_id, u.id AS user_id, p.id AS id, p.title, p.content, image, p.date, u.name AS user, c.name AS category
             FROM posts p
             INNER JOIN categories c on p.category_id = c.id
             INNER JOIN users u on p.user_id = u.id
             ORDER BY date DESC ;";
        $posts = $conn->query($posts_query);
        $posts_return = array();
        if($posts->num_rows >= 1) $posts_return = $posts;
        return $posts_return;
    }
    function getPost($conn, $id){
        $post_query = /** @lang text */
        "SELECT c.id AS category_id, u.id AS user_id, p.id AS id, p.title, p.content, image, p.date, u.name AS user, c.name AS category
             FROM posts p
             INNER JOIN categories c on p.category_id = c.id
             INNER JOIN users u on p.user_id = u.id
             WHERE p.id = $id";
        $post = $conn->query($post_query);
        if($post->num_rows == 1) return $post;
        header('Location:/index.php');
        return 0;
    }
    function getPostsByCategory($conn, $id){
        $post_query = /** @lang text */
        "SELECT c.id AS category_id, u.id AS user_id, p.id AS id, p.title, p.content, image, p.date, u.name AS user, c.name AS category
             FROM posts p
             INNER JOIN categories c on p.category_id = c.id
             INNER JOIN users u on p.user_id = u.id
             WHERE c.id = $id";
        $post = $conn->query($post_query);
        if($post->num_rows >= 0) return $post;
        else header('Location:/index.php');
        return 0;
    }
    function getPostsBySearch($conn, $search){
        $post_query = /** @lang text */
        "SELECT c.id AS category_id, u.id AS user_id, p.id, p.title, p.content, p.image, p.date, u.name AS user, c.name AS category
             FROM posts p
             INNER JOIN categories c on p.category_id = c.id
             INNER JOIN users u on p.user_id = u.id
             WHERE p.title LIKE '%$search%'";
        $post = $conn->query($post_query);
        if($post->num_rows >= 0) return $post;
        else header('Location:/index.php');
        return 0;
    }
    function getPostsByUserId($conn, $user_id){
        $post_query = /** @lang text */
        "SELECT id, title FROM posts p WHERE user_id = $user_id";
        $post = $conn->query($post_query);
        if($post->num_rows >= 0) return $post;
        else header('Location:/index.php');
        return 0;
    }

