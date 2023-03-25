<?php
$name = "";
$image = "";
$description = "";
$id=$_GET["id"];
include($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['name']))
        $name = $_POST['name'];
    if (isset($_POST['image']))
        $image = $_POST['image'];
    if (isset($_POST['description']))
        $description = $_POST['description'];

    if (!empty($name) && !empty($image) && !empty($description)) {
        $sql = "UPDATE `tbl_categories` SET `name` = ?, `image` = ?, `description` = ? WHERE `tbl_categories`.`id` = ?;";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$name, $image, $description, $id]);
        header("location: /");
        exit();
    }
}
if($_SERVER["REQUEST_METHOD"]=="GET") {
    $sql = "SELECT * FROM tbl_categories where id=".$id;
    $command = $dbh->query($sql);
    foreach($command as $row) {
        $image = $row["image"];
        $name = $row["name"];
        $description = $row["description"];
        break;
    }
}
?>

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
        <h1 class="text-center">Змінить категорію</h1>
        <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text"
                       class="form-control"
                       value="<?php echo $name; ?>"
                       id="name"
                       name="name" required>
                <div class="invalid-feedback">
                    Вкажіть назву категорії
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">URL фото</label>
                <input type="text"
                       value="<?php echo $image; ?>"
                       class="form-control"
                       id="image"
                       name="image" required>
                <div class="invalid-feedback">
                    Вкажіть шлях до фото категорії
                </div>
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control"
                              name="description"
                              placeholder="Leave a comment here"
                              id="description"
                              style="height: 100px" required><?php echo $description; ?></textarea>
                    <div class="invalid-feedback">
                        Вкажіть опис категорії
                    </div>
                    <label for="description">Опис</label>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>
    </div>
</main>


<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/bootstrap.validation.js"></script>
</body>
</html>