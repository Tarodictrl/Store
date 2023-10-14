<?php
namespace Registration;

include "config/DBConnector.php";
include "database/ProductDB.php";

session_start();

$pdo = \Store\Connection\Connection::get()->connect();
$product_db = new \Store\Product\ProductDB($pdo);
$products = $product_db->get_products();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head> 
<body>
    <header class="d-flex justify-content-center py-3 bg-dark">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Товары</a></li>
        <?php if(isset($_SESSION['userid'])) : ?>
            <li class="nav-item"><a href="#" class="nav-link">Корзина</a></li>
            <li class="nav-item"><a href="templates/account.php" class="nav-link">Личный кабинет</a></li>
            <li class="nav-item"><a href="scripts/logout.php" class="nav-link">Выйти</a></li>
        <?php else : ?>
            <li class="nav-item"><a href="templates/auth.php" class="nav-link">Войти</a></li>
            <li class="nav-item"><a href="templates/registration.php" class="nav-link">Регистрация</a></li>
        <?php endif; ?>
      </ul>
    </header>

    </div>
    <div class="main mt-5">
      <div class="row w-100 h-100">
        <?php foreach($products as $value): ?>
        <div class="col-auto">
          <div class="product ms-5 p-2">
            <div class="row">
              <img src="<?php echo($value["logo_path"]); ?>" alt="">
            </div>
            <div class="row m-0">
              <p>
                <b>
                  <?php echo($value["price"]); ?> р.
                </b>
              </p>
              <p>
                <?php echo($value["name"]); ?>
              </p>
              <button class="btn btn-success">
                Купить
              </button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <footer class="bg-dark text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3 text-white" style="background-color: rgba(0, 0, 0, 0.2); margin-top: 20px;">
            © 2023 Copyright:
            <a class="text-dark text-white" href="https://github.com/Tarodictrl">Daniil Detter</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>