<?php

if (isset($_POST)) {
    require_once 'connection.php';

    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : false;
    $age = isset($_POST['age']) ? $conn->real_escape_string($_POST['age']) : false;
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : false;
    $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : false;
    $password_confirm = isset($_POST['password_confirm']) ? $conn->real_escape_string($_POST['password_confirm']) : false;

    $errors = array();

    // Verify if the email already exists in the db
    $get_user_query = /** @lang text */
        "SELECT * FROM users WHERE email = '$email'";
    $get_user = $conn->query($get_user_query);
    if ($get_user->num_rows > 0) $errors['email_taken'] = 'Email is already taken';

    if (empty($name) || preg_match("/[0-9]/", $name)) $errors['name'] = "Name can't contains numbers.";

    if (empty($age) || !preg_match("/[0-9]/", $age) || $age < 12 || $age > 108) $errors['age'] = 'Please enter a valid age.';

    if (empty($email) || is_numeric($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Email is invalid, please enter a email with the following syntax: example@example.com';

    if (empty($password)) $errors['password'] = 'Password is invalid';

    if (strcmp($password, $password_confirm) != 0) $errors['confirm_password'] = 'Passwords do not match';

    if (empty($errors)) {
        $password_encrypted = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $query_insert = /** @lang text  * */
            "INSERT INTO users VALUES(NULL, '$name', $age, '$email', '$password_encrypted', CURDATE())";
        $result = $conn->query($query_insert);
        if ($result) {
            $_SESSION['register'] = 'You have successfully registered';
        } else {
            $_SESSION['errors']['general'] = 'Bad Request.';
        }
    } else {
        $_SESSION['errors'] = $errors;
    }
}
header('Location:/index.php');