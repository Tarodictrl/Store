<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    </div>
    <div class="main">
        <section>
            <div class="container">
                <div class="card d-flex align-items-center justify-content-center h-100">
                    <div class="card-body">
                        <h5 class="card-title">Вход</h5>
                        <form action="../scripts/auth.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Почта</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Введите почту" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" required>
                            </div>
                            <div id="error-container"></div>
                            <button type="submit" class="btn btn-primary mt-2">Войти</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>

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

            fetch('../scripts/auth.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(error => {
                displayError(error);
                if (error.length === 0) {
                    window.location.href = '../index.php';
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        });
    </script>
</body>
</html>