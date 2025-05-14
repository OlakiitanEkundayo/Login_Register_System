<?php
session_start();
require __DIR__ . '/config/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    //Validating inputs
    if (!$email) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if (!$password) {
        $errors[] = 'Password is required';
    }

    //If no error query the database
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT * FROM `users` WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header('Location: dashboard.php');
            exit;
        } else {
            $errors[] = 'Invalid email or password';
        }
    }

    // Save input data (except password fields) to session
    $_SESSION['registration-data'] = [
        'email' => $email
    ];

    // If there is an error
    $_SESSION['login_errors'] = $errors;
    header('Location: login.php');
    exit;
}
