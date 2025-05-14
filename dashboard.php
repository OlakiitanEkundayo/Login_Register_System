<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
require __DIR__ . '/includes/function.php';

$username = ($_SESSION['username']);
$email = ($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="./assets/css/dashboard.css">
</head>

<body>
  <header>
    <h2>Welcome, <?= e($username); ?></h2>
    <a href="logout.php" class="logout-btn">Logout</a>
  </header>

  <div class="container">
    <div class="dashboard-grid">
      <div class="card">
        <h3>Account Overview</h3>
        <p><strong>Username:</strong> <?= e($username) ?></p>
        <p><strong>Email:</strong> <?= e($email) ?></p>
        <p><strong>Status:</strong> Active</p>
      </div>

      <div class="card">
        <h3>Quick Actions</h3>
        <ul>
          <li><a href="#">Update Profile</a></li>
          <li><a href="#">View Results</a></li>
          <li><a href="#">Notification Settings</a></li>
        </ul>
      </div>

      <div class="card">
        <h3>Recent Activity</h3>
        <p>No recent activity yet.</p>
      </div>
    </div>
  </div>
</body>

</html>