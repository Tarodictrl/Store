<?php

namespace Registration;

include "../config/DBConnector.php";
include "../database/UserDB.php";

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pdo = \Store\Connection\Connection::get()->connect();
    $user_db = new \Store\User\UserDB($pdo);
    $row = $user_db->get_user($email);
    if ($row == -1)
    {
        $error .= 'Пользователь с такой почтой не зарегистрирован!';
    }
    else if (password_verify($password, $row['password']))
    {
        $_SESSION["userid"] = $row['id'];
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