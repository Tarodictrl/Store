<?php

namespace Registration;

include "../config/DBConnector.php";
include "../database/UserCRUD.php";

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pdo = \Store\Connection\Connection::get()->connect();
    $user_crud = new \Store\User\UserCRUD($pdo);
    $row = $user_crud->get_user($email);
    if ($row == -1)
    {
        $error .= 'Пользователь с такой почтой не зарегистрирован!';
    }
    else if (password_verify($password, $row['password']))
    {
        $_SESSION["userid"] = $row['id']; 
        $_SESSION["email"] = $row['email']; 
    }
    else
    {
        $error .= 'Неправильный пароль!';
    }
} else {
    $error .= "Неверный метод запроса.";
}
echo($error);
?>