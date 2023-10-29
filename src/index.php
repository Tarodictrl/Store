<?php
namespace Registration;

include "config/DBConnector.php";
include "database/CategoryCRUD.php";
include "database/ProductCRUD.php";

session_start();

$pdo = \Store\Connection\Connection::get()->connect();
$category_crud = new \Store\Category\CategoryCRUD($pdo);
$product_crud = new \Store\Product\ProductCRUD($pdo);
$category = $category_crud->get_categories();
$category_id = $_GET['category'];
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
            <li class="nav-item"><a href="#" class="nav-link">Заказы</a></li>
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
      <div class="row w-100 h-100 justify-content-center">
        <?php if(isset($category_id)) : $products=$product_crud->get_products($category_id);?>
          <?php if($products != -1) : ?>
            <div class="row justify-content-center">
              <a href="index.php" class="btn btn-primary w-auto mb-3">Назад к категориям</a>
            </div>
            <?php foreach($products as $value): ?>
              <div class="col-auto">
                <div class="product ms-5 p-2 mb-5">
                  <div class="row">
                    <img src="<?php echo($value["logo_path"]); ?>" data-bs-toggle="modal" data-bs-target="#productModal<?php echo($value["id"]); ?>">
                  </div>
                  <div class="row m-0">
                    <p>
                      <b class="price">
                        <?php echo($value["price"]); ?>
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
              <!-- Modal -->
              <div class="modal fade" id="productModal<?php echo($value["id"]); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><?php echo($value["name"]); ?></h5>
                      <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-auto">
                          <img src="<?php echo($value["logo_path"]); ?>" data-bs-toggle="modal" data-bs-target="#productModal<?php echo($value["id"]); ?>" height="200">
                        </div>
                        <div class="col">
                          <p >
                            <?php echo($value["description"]); ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                      <button type="button" class="btn btn-success">Купить</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <div class="d-flex align-items-center justify-content-center bg-dark p-3">
              <div class="text-center text-white">
                  <h1 class="display-1 fw-bold">404</h1>
                  <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
                  <p class="lead">
                      The page you’re looking for doesn’t exist.
                    </p>
                  <a href="/" class="btn btn-primary">Go Home</a>
              </div>
            </div>
          <?php endif; ?>
        <?php else : ?>
          <?php foreach($category as $value): ?>
            <div class="col-auto">
              <div class="category ms-5 p-2 text-center text-white mb-5">
                  <a href="?category=<?php echo($value["id"]); ?>" class="fw-bold text-decoration-none text-primary">
                    <img src="<?php echo($value["logo_path"]); ?>">
                    <p>
                      <?php echo($value["name"]); ?>
                    </p>
                  </a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <footer class="bg-dark text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3 text-white" style="background-color: rgba(0, 0, 0, 0.2); margin-top: 20px;">
            © 2023 Copyright:
            <a href="https://github.com/Tarodictrl">Daniil Detter</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      let caseSumsToSep = document.querySelectorAll('b.price');
      caseSumsToSep.forEach(makeNumSep);
      function makeNumSep(item, index) {
        let workValue = item.innerHTML;
        item.innerHTML = parseFloat(workValue).toLocaleString('ru-RU', {maximumFractionDigits: 2}).replace(',', '.') + " ₽";
      }
    </script>
</body>
</html>