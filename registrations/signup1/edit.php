<?php
include 'header.php';
include 'connect.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch current product info with category_id
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Product not found.</div>";
    include 'footer.php';
    exit();
}

$product = mysqli_fetch_assoc($result);

// Fetch all categories
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = intval($_POST['category']);  // category is now the ID
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);

    $updateSql = "
        UPDATE products 
        SET name='$name', category_id=$category_id, description='$description', price=$price 
        WHERE id=$id
    ";

    if (mysqli_query($conn, $updateSql)) {
        echo "<div class='alert alert-success'>Product updated successfully!</div>";
        // Refresh product data
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<h2 class="mb-4 text-primary fw-bold">Edit Product</h2>

<div class="card p-4 shadow-sm rounded-3 bg-white" style="max-width: 600px;">
  <form action="edit.php?id=<?= $id ?>" method="POST">
    <div class="mb-3">
      <label for="name" class="form-label fw-semibold">Product Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="category" class="form-label fw-semibold">Category</label>
      <select class="form-select" id="category" name="category" required>
        <option value="">-- Select Category --</option>
        <?php while ($cat = mysqli_fetch_assoc($categories)): ?>
          <option value="<?= $cat['id'] ?>" <?= ($product['category_id'] == $cat['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat['name']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label fw-semibold">Description</label>
      <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label fw-semibold">Price (USD)</label>
      <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-2"></i>Update Product</button>
  </form>
</div>

<?php include 'footer.php'; ?>
