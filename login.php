<?php session_start();

require __DIR__ . '/includes/function.php';
$errors = $_SESSION['login_errors'] ?? [];
unset($_SESSION['login_errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>

        <!-- Display a successful message -->
        <?php if (isset($_SESSION['register_success'])): ?>
            <div class="success-message">
                <p style="color: green;"><?php echo e($_SESSION['register_success']); ?></p>
                <?php unset($_SESSION['register_success']); ?>
            </div>
        <?php endif; ?>

        <!-- Display an error message -->
        <?php foreach ($errors as $error): ?>
            <div class="error-message">
                <p style="color: red;"><?php echo e($error); ?></p>
            </div>
        <?php endforeach; ?>

        <form action="login_process.php" method="POST">
            <input type="email" name="email" placeholder="Email" value="<?php echo e($_SESSION['registration-data']['email'] ?? ''); ?>" required />
            <input
                type="password"
                name="password"
                placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
        <p class="login-text">Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>

</body>

</html>