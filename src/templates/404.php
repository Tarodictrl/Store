<?php
session_start();
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
        <li class="nav-item"><a href="../index.php" class="nav-link" aria-current="page">Домой</a></li>
        <?php if(isset($_SESSION['userid'])) : ?>
            <li class="nav-item"><a href="#" class="nav-link">Корзина</a></li>
            <li class="nav-item"><a href="account.php" class="nav-link">Личный кабинет</a></li>
            <li class="nav-item"><a href="../scripts/logout.php" class="nav-link">Выйти</a></li>
        <?php else : ?>
            <li class="nav-item"><a href="auth.php" class="nav-link">Войти</a></li>
            <li class="nav-item"><a href="registration.php" class="nav-link">Регистрация</a></li>
        <?php endif; ?>
      </ul>
    </header>

    </div>
    <div class="main">
        <div class="d-flex align-items-center justify-content-center">
            <div class="text-center">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="fs-3"> <span class="text-danger">Opps!</span> Страница не найдена</p>
                <p class="lead">
                    Этой страницы не существует
                </p>
                <a href="/" class="btn btn-primary">Назад</a>
            </div>
        </div>
    </div>
    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2); margin-top: 20px;">
            © 2023 Copyright:
            <a class="text-white" href="https://github.com/Tarodictrl">Daniil Detter</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>