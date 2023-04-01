<?php
$name = "";
$description = "";
if($_SERVER["REQUEST_METHOD"]=="POST") {
    include($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
    if (isset($_POST['name']))
        $name = $_POST['name'];
    if (isset($_POST['description']))
        $description = $_POST['description'];

    $target_dir = $_SERVER["DOCUMENT_ROOT"]."/uploads/"; //папка на сервері куди зберігаємо файл
    $uploadFileName=$_FILES["image"]["name"]; //витягуємо імя файлу, який передає клієнт
    $exp = strtolower(pathinfo(basename($uploadFileName), PATHINFO_EXTENSION)); //з файлу отримали розширення
    $fileName = uniqid().".".$exp; //унікальне імя для файлу
    $fileSave = $target_dir.$fileName; //місце збереження файлу
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $fileSave)) {
        if (!empty($name) && !empty($description)) {
            $sql = "INSERT INTO tbl_categories (name, image, description) VALUES (?,?,?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$name, $fileName, $description]);
            header("location: /");
            exit();
        }
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
        <h1 class="text-center">Додати категорію</h1>
        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
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
                <label for="image" class="form-label">
                    <img src="/uploads/upload.png"
                         style="cursor: pointer"
                         alt="фото категорії"
                         id="selectImage"
                        width="170">
                </label>
                <input type="file"
                       class="d-none"
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

            <button type="submit" class="btn btn-primary">Додати</button>
        </form>
    </div>
</main>


<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/bootstrap.validation.js"></script>
<script>
    window.addEventListener("load", (event)=> {
        const image = document.getElementById("image");
        image.onchange=(e) => {
            const file = e.target.files[0];
            console.log("User select file", file);
            document.getElementById("selectImage").src=URL.createObjectURL(file);
        }
    });
</script>
</body>
</html>