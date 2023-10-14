<?php

namespace Registration;

include "../config/DBConnector.php";
include "../database/UserDB.php";

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fio = $_POST['fio'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $password_confirm = $_POST['password-confirm'];
    $bdate = $_POST['bdate'];
    $pdo = \Store\Connection\Connection::get()->connect();
    $user_db = new \Store\User\UserDB($pdo);
    if ($user_db->get_user($email) != -1)
    {
        $error .= 'Пользователь с такой почтой уже зарегистрирован!';
    }
    else if (strlen($password ) < 6)
    {
            $error .= 'Пароль должен содержать 6 символов.';
    }
    else if ($password != $password_confirm)
    {
        $error .= 'Пароли не совпадают.';
    }
    if (empty($error) ) {
        $id = $user_db->registration($email, $hash_password, $fio, $bdate);
        $_SESSION["userid"] = $id;
        $_SESSION["email"] = $email;
    }
} else {
    $error .= "Неверный метод запроса.";
}
echo($error);
?>