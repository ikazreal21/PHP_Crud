<?php

/** @var \PDO */
require_once '../../database.php';

$search = $_GET['search'] ?? '';
if ($search) {
    $statement = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
    $statement->bindValue(':title', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
}

$statement->execute();
$procdata = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include_once "../../views/partials/header.php";?>

    <h1>Product Crud</h1>
    <p>
      <a href="create.php" class="btn btn-success">Create Product</a>
    </p>

    <form action="" method="get">
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Search Product"
        name="search"
        value="<?php echo $search; ?>"
      />
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </div>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Create Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($procdata as $i =>
    $item): ?>
        <tr>
          <th scope="row"><?php echo ++$i; ?></th>
          <td></td>
          <td><?php echo $item['title']; ?></td>
          <td><?php echo $item['price']; ?></td>
          <td><?php echo $item['create_date']; ?></td>
          <td>
            <a
              href="update.php?id=<?php echo $item['prodid']; ?>"
              class="btn btn-sm btn-warning"
            >
              EDIT</a
            >
            <form
              style="display: inline-block"
              method="POST"
              action="delete.php"
            >
              <input
                type="hidden"
                name="id"
                value="<?php echo $item['prodid']; ?>"
              />
              <button type="submit" class="btn btn-sm btn-danger">
                DELETE
              </button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </body>
</html>
