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
</head>
<body>
    <header class="d-flex justify-content-center py-3 bg-dark">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Домой</a></li>
        <?php if(isset($_SESSION['userid'])) : ?>
            <li class="nav-item"><a href="#" class="nav-link">Корзина</a></li>
            <li class="nav-item"><a href="scripts/logout.php" class="nav-link">Выйти</a></li>
        <?php else : ?>
            <li class="nav-item"><a href="templates/auth.php" class="nav-link">Войти</a></li>
            <li class="nav-item"><a href="templates/registration.php" class="nav-link">Регистрация</a></li>
        <?php endif; ?>
      </ul>
    </header>

    </div>
    <div class="main">

    </div>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>