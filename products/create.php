<?php
$name = "";
$price = "";
$category_id = "";
$description = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
    if (isset($_POST['name']))
        $name = $_POST['name'];
    if (isset($_POST['description']))
        $description = $_POST['description'];
    if (isset($_POST['category_id']))
        $category_id = $_POST['category_id'];
    if (isset($_POST['price']))
        $price = $_POST['price'];

    if (!empty($name) && !empty($description) && !empty($category_id) && !empty($price)) {
        include($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
        $sql = "INSERT INTO tbl_products (name, category_id, price, description) VALUES (?,?,?,?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$name, $category_id, $price, $description]);

        $sql = "SELECT LAST_INSERT_ID() as id;";
        $item = $dbh->query($sql)->fetch();
        $insert_id = $item['id'];

        $images = $_POST["images"];
        foreach ($images as $base64) {
            list(, $content) = explode(',', $base64);
            $bytes = base64_decode($content);
            $target_dir = $_SERVER["DOCUMENT_ROOT"] . "/uploads/"; //папка на сервері куди зберігаємо файл
            $fileName = uniqid() . ".jpg"; //унікальне імя для файлу
            $fileSave = $target_dir . $fileName; //місце збереження файлу
            file_put_contents($fileSave, $bytes);
            $sql = 'INSERT INTO  tbl_product_images (name, product_id) VALUES(:name,:product_id);';
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':name', $fileName);
            $stmt->bindParam(':product_id', $insert_id);
            $stmt->execute();
        }
        header("location: /products/list.php");
        exit();
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
        <h1 class="text-center">Додати товар</h1>
        <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text"
                       class="form-control"
                       value="<?php echo $name; ?>"
                       id="name"
                       name="name" required>
                <div class="invalid-feedback">
                    Вкажіть назву товара
                </div>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Категорія</label>
                        <input type="text"
                               class="form-control"
                               id="category_id"
                               name="category_id" required>
                        <div class="invalid-feedback">
                            Вкажіть категорію
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Ціна</label>
                        <input type="text"
                               class="form-control"
                               id="price"
                               name="price" required>
                        <div class="invalid-feedback">
                            Вкажіть ціну
                        </div>
                    </div>
                </div>

            </div>
            <div class="mb-3">
                <div class="row" id="listImages">
                </div>

                <div class="col-md-2">
                    <label for="image" class="form-label">
                        <img src="/uploads/upload.png"
                             style="cursor: pointer"
                             alt="фото категорії"
                             id="selectImage"
                             width="120">
                    </label>
                    <input type="file"
                           class="d-none"
                           id="image">
                </div>
                <div class="invalid-feedback">
                    Вкажіть шлях до фото товару
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
                        Вкажіть опис товару
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
    window.addEventListener("load", (event) => {
        const image = document.getElementById("image");
        image.onchange = (e) => {
            const file = e.target.files[0];
            const fr = new FileReader();
            fr.addEventListener("load", () => {
                const base64 = fr.result;
                const data = `
                            <div class="col-md-2">
                                <img src="${base64}"
                                     style="cursor: pointer"
                                     alt="фото категорії"
                                     width="100%">

                                <input type="hidden"
                                       class="d-none"
                                       value="${base64}"
                                       name="images[]">
                            </div>`;

                document.getElementById("listImages").innerHTML += data;

            });
            fr.readAsDataURL(file);

            image.value = "";
        }
    });
</script>
</body>
</html>