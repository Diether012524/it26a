<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'header.php';
include 'connect.php';

$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "
        SELECT products.*, categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        WHERE products.name LIKE '%$search%' OR categories.name LIKE '%$search%'
        ORDER BY products.id DESC
    ";
} else {
    $sql = "
        SELECT products.*, categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        ORDER BY products.id DESC
    ";
}
$result = mysqli_query($conn, $sql);
?>

<style>
body {
  background-color: #f7f9fc;
  font-family: 'Poppins', sans-serif;
}

h2 {
  color: #264653;
}

.card-product {
  border-radius: 16px;
  border: none;
  background: #ffffff;
  box-shadow: 0 4px 14px rgba(0,0,0,0.08);
  transition: transform 0.2s ease, box-shadow 0.3s ease;
}
.card-product:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.12);
}

.btn-primary {
  background-color: #2a9d8f;
  border: none;
}
.btn-primary:hover {
  background-color: #21867a;
}

.btn-outline-primary {
  border-color: #2a9d8f;
  color: #2a9d8f;
}
.btn-outline-primary:hover {
  background-color: #2a9d8f;
  color: white;
}

.btn-outline-dark {
  border-color: #6c757d;
  color: #6c757d;
}
.btn-outline-dark:hover {
  background-color: #6c757d;
  color: white;
}

.card-title {
  font-weight: 600;
  color: #2a9d8f;
}

.card-subtitle {
  color: #6c757d;
}

.card-text {
  color: #495057;
}

.alert-warning {
  background-color: #fff3cd;
  border: 1px solid #ffeeba;
}
</style>

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
  <span class="text-muted">Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
</div>

<!-- Search & Actions -->
<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
  <form class="d-flex flex-grow-1" method="GET" action="dashboard.php">
    <input 
      type="text" 
      name="search" 
      class="form-control shadow-sm me-2" 
      placeholder="🔍 Search by product or category..." 
      value="<?= htmlspecialchars($search) ?>" 
    />
    <button type="submit" class="btn btn-outline-primary shadow-sm">Search</button>
  </form>

  <div class="d-flex gap-2">
    <a href="dashboard_join.php" class="btn btn-outline-dark shadow-sm">
      <i class="fas fa-layer-group me-1"></i> View with Joins
    </a>
    <a href="add.php" class="btn btn-primary shadow-sm">
      <i class="fas fa-plus-circle me-1"></i> Add Product
    </a>
  </div>
</div>

<!-- Product Cards -->
<?php if (mysqli_num_rows($result) > 0): ?>
  <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="col">
        <div class="card card-product h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
            <h6 class="card-subtitle mb-2"><?= htmlspecialchars($row['category_name'] ?? 'Uncategorized') ?></h6>
            <p class="card-text flex-grow-1">
              <?= htmlspecialchars(strlen($row['description']) > 100 ? substr($row['description'], 0, 100) . '...' : $row['description']) ?>
            </p>
            <p class="fw-bold fs-5 text-success">$<?= number_format($row['price'], 2) ?></p>
            <div class="d-flex justify-content-between mt-3">
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-edit"></i> Edit
              </a>
              <a href="delete.php?id=<?= $row['id'] ?>" 
                 onclick="return confirm('Are you sure you want to delete this product?');"
                 class="btn btn-sm btn-outline-danger">
                <i class="fas fa-trash-alt"></i> Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <div class="alert alert-warning shadow-sm">
    <i class="fas fa-info-circle"></i> No products found. Try searching again or <a href="add.php" class="alert-link">add a new one</a>.
  </div>  
<?php endif; ?>

<?php include 'footer.php'; ?>
