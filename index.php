<?php
session_start();
require 'config.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin'){
        header("Location: Admin/dashboard.php");
    } else if ($_SESSION['role'] == 'user') {
        header("Location: User/dashboard.php");
    }
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?"); //sesuaikan dengan nama table masing masing kelompok
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password']) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: Admin/dashboard.php");
        } else if ($user['role'] === 'user') {
            header("Location: User/dashboard.php");
        }
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
    <link rel="stylesheet" href="style.css">
<body>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="container">
        <h2>Form Login</h2>
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>


