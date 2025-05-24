<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'header.php';
include 'connect.php';

/*
  LEFT JOIN is used to retrieve all products along with their category names.
  Products without a category will still appear as 'Uncategorized'.
*/

$sql = "
SELECT 
  products.name AS product_name,
  products.description,
  products.price,
  products.category_id,
  categories.name AS category_name
FROM products
LEFT JOIN categories ON products.category_id = categories.id
ORDER BY products.id DESC

";

$result = mysqli_query($conn, $sql);
?>

<!-- Custom styles for the join table -->
<style>
  .join-table-container {
    margin-top: 60px;
    padding: 25px;
    background-color: #ffffff;
    border-radius: 12px;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  }

  .join-table-container h2 {
    margin-bottom: 20px;
    color: #2c5364;
    font-weight: 700;
  }

  .table-bordered th,
  .table-bordered td {
    vertical-align: middle;
    border: 1px solid #dee2e6;
  }

  .table thead th {
    background: linear-gradient(to right, #1c92d2, #f2fcfe);
    color: #333;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
  }

  .table-hover tbody tr:hover {
    background-color: #f1f5f9;
    cursor: pointer;
  }

  .table td {
    padding: 12px 15px;
  }
</style>

<div class="join-table-container">
  <h2><i class="fas fa-link me-2 text-primary"></i>Product & Category Overview</h2>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Category ID</th>

          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= htmlspecialchars($row['product_name']) ?></td>
              <td><?= htmlspecialchars($row['description']) ?></td>
              <td>$<?= number_format($row['price'], 2) ?></td>
              <td><?= htmlspecialchars($row['category_name'] ?? 'Uncategories') ?></td>
              <td><?= htmlspecialchars($row['category_id']) ?></td>

            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No product data available.</div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
