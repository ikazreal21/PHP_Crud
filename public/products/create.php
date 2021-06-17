<?php

/** @var \PDO */
require_once '../../database.php';

// echo "<pre>";
// var_dump($_FILES);
// echo "</pre>";
// exit;

$errors = [];

$title = '';
$desc = '';
$price = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../validateform.php';

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
              VALUES (:title, :image, :description, :price, :date)"
        );

        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', '');
        $statement->bindValue(':description', $desc);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->execute();

        header('Location: index.php');
    }

}

?>

<?php include_once "../../views/partials/header.php";?>

    <h1>Create Product</h1>
    <p>
      <a href="index.php" class="btn btn-success">Go back</a>
    </p>

    <?php if (empty($errors) && !empty($title)): ?>
      <div class="alert alert-success">
          <div>New Product Added</div>
      </div>
    <?php endif;?>

    <?php include_once "../../views/products/form.php";?>

  </body>
</html>
