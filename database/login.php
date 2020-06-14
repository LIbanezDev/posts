<?php
    if(isset($_POST)) {
        require_once 'connection.php';
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error = false;
        $get_user = /** @lang text */ "SELECT * FROM users WHERE email = '$email'";
        $user = $conn->query($get_user);
        if($user->num_rows == 1){
            $user_data = $user->fetch_assoc();
            if(password_verify($password, $user_data['password'])){
                $_SESSION['user_data'] = $user_data;
                if(isset($_SESSION['login_error'])) unset($_SESSION['login_error']);
            }else{
                $error = true;
            }
        }else{
            $error = true;
        }
        if($error) $_SESSION['login_error'] = 'Invalid validation, check your email and password.';
    }
    header('Location:/index.php');