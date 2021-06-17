<?php

/** @var \PDO */
require_once '../../database.php';

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

    require_once '../../validateform.php';

    if (empty($errors)) {

        $statement = $pdo->prepare("UPDATE products set title = :title, image = :image, description = :description, price = :price WHERE prodid = :id");

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

<?php include_once "../../views/partials/header.php";?>

    <h1>Update Product <?php echo $prod['title']; ?></h1>
    <p>
      <a href="index.php" class="btn btn-secondary">Go back</a>
    </p>

<?php include_once "../../views/products/form.php";?>

  </body>
</html>
