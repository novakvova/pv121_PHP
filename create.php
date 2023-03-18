<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна сторінка</title></head>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/style.css">
<body>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/_header.php"); ?>

<main>
    <div class="container">
        <h1 class="text-center">Додати категорію</h1>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">URL фото</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control"
                              name="description"
                              placeholder="Leave a comment here"
                              id="description"
                              style="height: 100px"></textarea>
                    <label for="description">Опис</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Додати</button>
        </form>
    </div>
</main>


<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>