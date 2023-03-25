<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна сторінка</title></head>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/style.css">
<body>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/_header.php"); ?>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>

<main>
    <div class="container">
        <h1 class="text-center">Список товарів</h1>
        <a href="/products/create.php" class="btn btn-success">Додати товар</a>
        <div class="row">
            <?php
            for ($i = 0; $i < 15; $i++) {
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card" style="width: 100%;">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpwn7H91r9D9zlqiuBTajoSfKuCvC8o9Hv7A&usqp=CAU"
                             class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</main>
<script src="/js/bootstrap.bundle.min.js"></script>

</body>
</html>