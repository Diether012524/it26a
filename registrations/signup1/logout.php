<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logging Out...</title>
  <meta http-equiv="refresh" content="3;url=login.php">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(-45deg, #ff6e7f, #bfe9ff, #ff6e7f, #bfe9ff);
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
      background: linear-gradient(to right, #ff6e7f, #bfe9ff);
      border-radius: 20px;
    }

    h2 {
      font-weight: 700;
      color: #ff6e7f;
    }

    .form-label {
      font-weight: 600;
    }

    .form-control {
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #ff6e7f;
      box-shadow: 0 0 0 0.2rem rgba(255, 110, 127, 0.25);
    }

    .btn-primary {
      background: #ff6e7f;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: #d9525e;
      transform: scale(1.02);
    }

    .text-white a {
      color: #fff;
      font-weight: 600;
    }

    .text-white a:hover {
      text-decoration: underline;
    }

    .logout-box {
      text-align: center;
      background: white;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      border: 3px solid transparent;
      position: relative;
      max-width: 420px;
      width: 100%;
    }

    .spinner-border {
      color: #ff6e7f !important;
      margin-top: 15px;
      width: 3rem;
      height: 3rem;
    }

    p {
      margin-top: 0.5rem;
      color: #555;
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="logout-box">
  <h2>You’ve been logged out</h2>
  <p>Redirecting you to the login page...</p>
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

</body>
</html>
