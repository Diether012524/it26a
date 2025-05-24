<?php
include 'header.php';
include 'connect.php';

$message = '';

// Fetch categories from DB
$categoryQuery = "SELECT id, name FROM categories ORDER BY name ASC";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $category_id = intval($_POST['category']); // from dropdown
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);

    if ($price <= 0) {
        $message = "<div class='alert alert-danger'>Price must be greater than zero.</div>";
    } else {
        // Insert using category_id
        $stmt = $conn->prepare("INSERT INTO products (name, category_id, description, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisd", $name, $category_id, $description, $price);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Product added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . htmlspecialchars($stmt->error) . "</div>";
        }

        $stmt->close();
    }
}
?>

<h2 class="mb-4 text-primary fw-bold">Add New Product</h2>

<?= $message ?>

<div class="card p-4 shadow-sm rounded-3 bg-white" style="max-width: 600px;">
  <form action="add.php" method="POST">
    <div class="mb-3">
      <label for="name" class="form-label fw-semibold">Product Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
    </div>

    <div class="mb-3">
      <label for="category" class="form-label fw-semibold">Category</label>
      <select class="form-select" id="category" name="category" required>
        <option value="" disabled selected>Select category</option>
        <?php while ($cat = mysqli_fetch_assoc($categoryResult)): ?>
          <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label fw-semibold">Description</label>
      <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the product" required></textarea>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label fw-semibold">Price (USD)</label>
      <input type="number" step="0.01" min="0.01" class="form-control" id="price" name="price" placeholder="Enter price" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">
      <i class="fas fa-plus-circle me-2"></i>Add Product
    </button>
  </form>
</div>

<?php include 'footer.php'; ?>
