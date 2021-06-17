
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
        <textarea class="form-control" name="description" ><?php echo $desc; ?></textarea>
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