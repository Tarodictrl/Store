<?php

namespace Registration;

include "../config/DBConnector.php";
include "../database/UserDB.php";

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = \Store\Connection\Connection::get()->connect();
    $user_db = new \Store\User\UserDB($pdo);
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
        $user_db->update($data, $email);
    }
}
else {
    $error .= "Неверный метод запроса.";
}
echo($error);
?>