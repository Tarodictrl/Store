<?php
session_start();

include "../config/DBConnector.php";
include "../database/UserDB.php";

if(!isset($_SESSION['userid']))
{
    header("Location: 404.php");
    exit;
}
$pdo = \Store\Connection\Connection::get()->connect();
$user_db = new \Store\User\UserDB($pdo);
$user = $user_db->get_user($_SESSION["email"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="d-flex justify-content-center py-3 bg-dark">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="../index.php" class="nav-link" aria-current="page">Товары</a></li>
        <?php if(isset($_SESSION['userid'])) : ?>
            <li class="nav-item"><a href="#" class="nav-link">Корзина</a></li>
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Личный кабинет</a></li>
            <li class="nav-item"><a href="../scripts/logout.php" class="nav-link">Выйти</a></li>
        <?php else : ?>
            <li class="nav-item"><a href="templates/auth.php" class="nav-link">Войти</a></li>
            <li class="nav-item"><a href="templates/registration.php" class="nav-link">Регистрация</a></li>
        <?php endif; ?>
      </ul>
    </header>

    </div>
    <div class="main">
        <div class="container mt-5">
            <div class="card d-flex align-items-center justify-content-center h-100">
                <div class="card-body text-white row">
                    <h5 class="card-title">Личные данные</h5>
                    <form action="../scripts/update.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                        <div class="col">
                            <?php if(isset($user['logo_path'])) : ?>
                            <img class="avatar p-0" src="<?php echo($user["logo_path"]) ?>" alt="">
                            <?php else : ?>
                                <img class="avatar p-0" src="..\assets\img\users\placeholder.png" alt="">
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="file" name="avatar" accept="image/*"><br><br>
                            </div>
                        </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ФИО</label>
                                    <input type="text" class="form-control" id="fio" name="fio" value="<?php echo($user["fio"]) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Почта</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo($user["email"]) ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Дата рождения</label>
                                    <input type="date" class="form-control" id="bdate" name="bdate" value="<?php echo($user["bdate"]) ?>">
                                </div>
                                <div id="error-container"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3 text-white" style="background-color: rgba(0, 0, 0, 0.2); margin-top: 20px;">
            © 2023 Copyright:
            <a class="text-white" href="https://github.com/Tarodictrl">Daniil Detter</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        function displayError(error) {
            var errorContainer = document.getElementById("error-container");
            errorContainer.innerHTML = '';
            if (error) {
                var errorHtml = '<div class="alert alert-danger mt-3" role="alert">';
                errorHtml += '<p>' + error + '</p>';
                errorHtml += '</div>';
                errorContainer.innerHTML = errorHtml;
            }
        }

        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch('../scripts/update.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(error => {
                displayError(error);
                if (error.length === 0) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        });
    </script>
</body>
</html>