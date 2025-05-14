<?php
session_start();
require __DIR__ . '/config/db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']) ?? "";
    $email = trim($_POST['email']) ?? "";
    $password = trim($_POST['password']) ?? "";
    $confirmPassword = trim($_POST['confirmpassword']) ?? "";

    //Validate the form inputs

    if (!$username) {
        $errors[] = 'Username is required.';
    }

    if (!$email) {
        $errors[] =  'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (!$password) {
        $errors[] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    if (!$confirmPassword) {
        $errors[] = 'Please confirm your password.';
    } elseif ($password !== $confirmPassword) {
        $errors[] = 'Password do not match.';
    }

    //Check if username and email has already been used
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT username, email FROM `users` WHERE username = :username or email = :email');
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['username'] === $username) {
                $errors[] = 'Username already exists';
            }

            if ($user['email'] === $email) {
                $errors[] = 'Email already exists';
            }
        }
    }

    // Handling the result and sending inputs to db
    if (!empty($errors)) {

        // Save input data (except password fields) to session
        $_SESSION['registration-data'] = [
            'username' => $username,
            'email' => $email
        ];

        $_SESSION['register_errors'] = $errors;
        header("Location: signup.php");
        exit;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = $pdo->prepare("INSERT INTO `users` (username, email, password) VALUES (:username, :email, :password)");
        $insert_query->bindValue(":username", $username);
        $insert_query->bindValue(":email", $email);
        $insert_query->bindValue(":password", $hashed_password);
        $insert_query->execute();

        $_SESSION['register_success'] = "Registration successful!";
        header('Location: login.php');
        exit;
    }
}
