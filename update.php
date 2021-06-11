<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', 'Zakizakizaki21%');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// echo "<pre>";
// var_dump($_FILES);
// echo "</pre>";
// exit;

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('SELECT * FROM products WHERE prodid = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$prod = $statement->fetch(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($prod);
// echo "</pre>";
// exit;

$errors = [];

$title = $prod['title'];
$desc = $prod['description'];
$price = $prod['price'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    if (!$title) {
        $errors[] = 'Product Title is Required';
    }

    if (!$desc) {
        $errors[] = 'Product Description is Required';
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE products set title = :title, image = :image, description = :description,
                            price = :price WHERE prodid = :id");

        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', '');
        $statement->bindValue(':description', $desc);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header('Location: index.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />

    <title>Update Product</title>
  </head>
  <body>
    <h1>Update Product <?php echo $prod['title']; ?></h1>
    <p>
      <a href="index.php" class="btn btn-secondary">Go back</a>
    </p>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
          <div><?php echo $error; ?></div>
        <?php endforeach?>
      </div>
    <?php endif;?>
    <form method="POST" action="" >
      <div class="form-group mb-3">
        <label class="form-label">Product Img</label>
        <input
          type="file"
          class="form-control"
          name="image"
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Product Name</label>
        <input
          type="text"
          class="form-control"
          name="title"
          value="<?php echo $title; ?>"
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Product Description</label>
        <textarea class="form-control" name="description" ><?php echo $desc; ?>
        </textarea>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Product Price</label>
        <input
          type="number"
          step=".01"
          class="form-control"
          name="price"
          value="<?php echo $price; ?>"
        />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
