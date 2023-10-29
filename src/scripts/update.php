<?php

namespace Registration;

include "../config/DBConnector.php";
include "../database/UserCRUD.php";

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = \Store\Connection\Connection::get()->connect();
    $user_crud = new \Store\User\UserCRUD($pdo);
    $uploadDirectory = '../assets/img/users/';
    $email = $_SESSION["email"];
    $data = $_POST;
    if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $tmpFilePath = $_FILES['avatar']['tmp_name'];
        $newFilePath = $uploadDirectory . $_FILES['avatar']['name'];

        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            $data['logo_path'] = $newFilePath;
        }
    }
    if (empty($error))
    {
        $user_crud->update($data, $email);
    }
}
else {
    $error .= "Неверный метод запроса.";
}
echo($error);
?>