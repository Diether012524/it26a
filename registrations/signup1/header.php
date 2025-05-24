<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f2f5;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Sidebar */
.sidebar {
  height: 100vh;
  width: 250px;
  position: fixed;
  top: 0;
  left: 0;
  background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
  padding-top: 60px;
  color: #fff;
  box-shadow: 4px 0 10px rgba(0, 0, 0, 0.15);
  z-index: 1000;
  transition: all 0.3s ease-in-out;
  border-right: 1px solid rgba(255, 255, 255, 0.08);
}

.sidebar .nav-link {
  color: #e2e8f0;
  padding: 14px 24px;
  font-weight: 500;
  font-size: 15px;
  display: flex;
  align-items: center;
  gap: 12px;
  border-radius: 8px;
  margin: 6px 10px;
  transition: all 0.3s ease-in-out;
  position: relative;
}

.sidebar .nav-link i {
  font-size: 18px;
  color: #38bdf8;
  transition: transform 0.2s;
}

.sidebar .nav-link span {
  transition: opacity 0.3s ease-in-out;
}

.sidebar .nav-link:hover, .sidebar .nav-link.active {
  background: rgba(56, 189, 248, 0.15);
  color: #ffffff;
  transform: translateX(4px);
  box-shadow: inset 4px 0 0 #38bdf8;
}

.sidebar .nav-link:hover i {
  transform: scale(1.1);
  color: #0ea5e9;
}

.sidebar .nav-link.active i {
  color: #0ea5e9;
}


    /* Content area */
    .content {
      margin-left: 250px;
      padding: 30px;
      min-height: 100vh;
    }

    /* Navbar top */
    .topbar {
      position: fixed;
      left: 250px;
      right: 0;
      height: 60px;
      background: #fff;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding: 0 30px;
      z-index: 1100;
    }

    .topbar .username {
      font-weight: 600;
      margin-right: 20px;
      color: #333;
    }

    /* Cards for products */
    .card-product {
      border-radius: 12px;
      box-shadow: 0 2px 12px rgb(0 0 0 / 0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-product:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgb(0 0 0 / 0.15);
    }

    /* Buttons */
    .btn-primary {
      background-color: #1c2533;
      border: none;
    }

    .btn-primary:hover {
      background-color: #3a475e;
    }
footer {
  text-align: center;
  background-color: #1c2533;
  color: #cbd5e1;
  padding: 15px 0;
  margin-top: 30px;  /* space above footer */
  font-weight: 500;
  font-size: 14px;
  width: 100%;
  margin-left: 95px;
}


    

    @media(max-width: 768px) {
      .sidebar {
        width: 60px;
        padding-top: 20px;
      }
      .sidebar .nav-link span {
        display: none;
      }
      .content {
        margin-left: 60px;
        padding: 20px;
      }
      .topbar {
        left: 60px;
      }
      footer {
        margin-left: 60px;
      }
    }
  </style>

</head>
<body>

<div class="sidebar">
  <nav class="nav flex-column">
    <a href="dashboard.php" class="nav-link active"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
    <a href="add.php" class="nav-link"><i class="fas fa-plus-circle"></i> <span>Add Product</span></a>
    <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
  </nav>
</div>

<div class="topbar">
  <div class="logo fw-bold me-auto text-primary" style="font-size: 20px;">TechFix Hub</div>
  <div class="username">Hello, <?= htmlspecialchars($_SESSION['username']) ?></div>
</div>

<div class="content">
