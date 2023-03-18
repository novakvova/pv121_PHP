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

<?php include($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>

<main>
    <div class="container">
        <h1 class="text-center">Список категорій</h1>
        <a href="/create.php" class="btn btn-success">Додати категорію</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Фото</th>
                <th scope="col">Навва</th>
                <th scope="col">Опис</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM tbl_categories";
            $command = $dbh->query($sql);
            foreach($command as $row) {
                $name = $row["name"];
                $image = $row["image"];
                $description = $row["description"];
                echo "
                <tr>
                    <td><img src='$image' width='50'/></td>
                    <td>$name</td>
                    <td>$description</td>
                </tr>
                ";
            }
            ?>

            </tbody>
        </table>
    </div>
</main>


<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>