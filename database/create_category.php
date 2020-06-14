<?php
    require_once 'connection.php';

    if(isset($_POST) && isset($_SESSION['user_data'])){
        $category = $_POST['name'];
        if(empty($category) || is_numeric($category) || preg_match("/[0-9]/", $category)){
            echo 'not valid';
        }else{
            $insert_cat_query = /** @lang text */ "INSERT INTO categories VALUES (NULL, '$category')";
            $result = $conn->query($insert_cat_query);
            if($result){
                $_SESSION['category_add'] = 'Category successfully added';
                header('Location:/index.php?category='.$conn->insert_id);
            }else{
                header('Location:/profile.php');
            }
        }
    }