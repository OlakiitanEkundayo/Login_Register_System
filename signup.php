<?php session_start();
require __DIR__ . '/includes/function.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="./assets/css/signup.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <div class="signup-container">
    <div class="signup-box">
      <h2>Sign up</h2>

      <?php if (isset($_SESSION['register_errors']) && is_array($_SESSION['register_errors'])): ?>
        <?php foreach ($_SESSION['register_errors'] as $error): ?>
          <p style="color: red;"><?php echo e($error); ?></p>
        <?php endforeach; ?>
        <?php unset($_SESSION['register_errors']); ?>
      <?php endif; ?>

      <form action="signup_process.php" method="POST">
        <input type="text" name="username" placeholder="Username" value="<?php echo e($_SESSION['registration-data']['username'] ?? '') ?>" required />

        <input type="email" name="email" placeholder="Email" value="<?php echo e($_SESSION['registration-data']['email'] ?? '') ?>" required />

        <input type="password" name="password" placeholder="Password" id="password" required />

        <input type="password" name="confirmpassword" placeholder="Confirm Password" id="confirmpassword" required />

        <span id="match-message"></span><br><br>
        <button type="submit" name="submit">Sign up</button>
        <?php unset($_SESSION['registration-data']); ?>
      </form>
      <p class="login-text">Already have an account? <a href="login.php">Login</a></p>
    </div>
  </div>
</body>

<script src="./assets/js/script.js"></script>

</html>