<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user already exists
    $checkSql = "SELECT * FROM `registration` WHERE username='$username'";
    $checkResult = mysqli_query($conn, $checkSql);

    if ($checkResult) {
        $numRows = mysqli_num_rows($checkResult);
        if ($numRows > 0) {
            echo "<script>alert('User already exists');</script>";
        } else {
            // Insert new user (for real app, hash password!)
            $insertSql = "INSERT INTO `registration` (username, password) VALUES ('$username', '$password')";
            $insertResult = mysqli_query($conn, $insertSql);

            if ($insertResult) {
                echo "<script>alert('Signup successful! Please login.'); window.location.href='login.php';</script>";
            } else {
                die("Insert Error: " . mysqli_error($conn));
            }
        }
    } else {
        die("Query Error: " . mysqli_error($conn));
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign Up - TechFix Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(-45deg, #6a11cb, #2575fc, #6a11cb, #2575fc);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .card {
      width: 100%;
      max-width: 420px;
      padding: 2rem;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      border: 3px solid transparent;
      background-clip: padding-box;
      position: relative;
    }

    .card::before {
      content: "";
      position: absolute;
      top: -3px;
      left: -3px;
      right: -3px;
      bottom: -3px;
      z-index: -1;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      border-radius: 20px;
    }

    h2 {
      font-weight: 700;
      color: #2575fc;
    }

    .form-label {
      font-weight: 600;
    }

    .form-control {
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #2575fc;
      box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, 0.25);
    }

    .btn-primary {
      background: #2575fc;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: #1458c6;
      transform: scale(1.02);
    }

    .text-white a {
      color: #fff;
      font-weight: 600;
    }

    .text-white a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2 class="text-center mb-4">Create an Account</h2>
    <form action="sign.php" method="POST" novalidate>
      <div class="mb-4">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Enter username" required />
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter password" required />
      </div>
      <button type="submit" class="btn btn-primary w-100 btn-lg">Sign Up</button>
    </form>
    <p class="text-center mt-4">Already have an account? <a href="login.php">Login here</a></p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
